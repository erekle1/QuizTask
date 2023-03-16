<template>
    <div v-if="!isFinished">
        <div class="flex justify-center space-x-1.5">
            <button @click="mode=1"
                    class="px-4  py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition  border-gray-600  active:bg-gray-700 focus:ring-gray-300"
                    :class="{'bg-gray-600 text-white':mode===1}">
                Multiple Choice
            </button>
            <button @click="mode=0"
                    class="px-4  py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition  border-gray-600  active:bg-gray-700 focus:ring-gray-300"
                    :class="{'bg-gray-600 text-white':mode===0}">
                Binary
            </button>
        </div>

        <div class="col-6"></div>
        <progress-bar :size="quoteOrder"/>
        <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 justify-center">
            <h6 class=" font-bold mb-4 mt-0"> Who said it?</h6>
            <p class="text-gray-700 text-sm mb-6">{{ quoteOrder }}. {{ quote.name }}</p>
            <div class="grid grid-cols-2 gap-8">
                <div v-if="mode===1" v-for="(answer, i) in quote.answers" @click="submitAnswer(answer)"
                     :class="{'ring-green-800 bg-green-800' :rightAnswer.id === answer.id, 'ring ring-red-800 bg-red-800': answer.id===selectedAnswer.id && rightAnswer.id !== answer.id, 'cursor-not-allowed': selectedAnswer !==false}"
                     class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                    {{ i + 1 }}. {{ answer.answer }}
                </div>
                <div v-if="mode===0" class="col-span-2">
                    {{ randomAnswer.answer }}
                </div>
                <div v-if="mode===0" @click="submitAnswer(randomAnswer)"
                     :class="{'ring-green-800 bg-green-800' :rightAnswer.id === randomAnswer.id, 'ring ring-red-800 bg-red-800': randomAnswer.id===selectedAnswer.id && rightAnswer.id !== randomAnswer.id, 'cursor-not-allowed': selectedAnswer !==false}"
                     class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                    Yes
                </div>
                <div v-if="mode===0" @click="submitAnswer('no')"
                     :class="{'ring-green-800 bg-green-800' :rightAnswer.id !== randomAnswer.id && this.selectedAnswer==='no', 'ring ring-red-800 bg-red-800': rightAnswer.id === randomAnswer.id, 'cursor-not-allowed': selectedAnswer !==false}"
                     class="ring ring-offset-1  text-white rounded cursor-pointer p-2.5 shadow ring ring-gray-800 bg-gray-800">
                    No
                </div>

            </div>
            <div class="mt-10" v-if="selectedAnswer">
                <span class="text-green-900"
                      v-if="selectedAnswer.id===rightAnswer.id || (mode ===0 && selectedAnswer==='no' && rightAnswer.id !== randomAnswer.id)"> Correct! </span>
                <span v-else class="text-red-900">Sorry, You are wrong.</span>
                The right answer is {{ rightAnswer.answer }}
            </div>
        </div>
        <button @click.prevent="nextQuote" v-if="quoteOrder < numOfQuotes"
                :class="{'opacity-30 cursor-not-allowed':selectedAnswer===false}"
                class="px-4 py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300 float-right">
            Next
        </button>
        <button v-else @click.prevent="finish()"
                class="px-4 py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300 float-right">
            Finish
        </button>
    </div>
    <div v-else>
        Your success rate is {{ successRate }}%
        <button @click.prevent="start()"
                class="px-4 py-2 mt-10 rounded-md text-sm font-medium border focus:outline-none focus:ring transition text-gray-600 border-gray-600 hover:text-white hover:bg-gray-600 active:bg-gray-700 focus:ring-gray-300">
            Start Again
        </button>
    </div>

</template>

<script>
import {mapActions, mapGetters} from "vuex";
import ProgressBar from "./ProgressBar";

export default {
    name: "Quote",
    data() {
        return {
            selectedAnswer: false,
            randomAnswer: false,
            rightAnswer: false,
            quote: {},
            numOfQuotes: 0,
            quoteOrder: 1,
            mode: 1,
            correctAnswersCount: 0,
            isFinished: false,

        };
    },
    created() {
        //if user is not created, create it
        if (this.getUser() !== "testUser") {
            this.setUser();
            this.updateNumOfUsers();
        }

        //destroy user after close browser
        window.addEventListener('beforeunload', () => {
            this.destroyUser()
        })

        //get quiz data
        this.fetchQuiz().then(() => {
            this.quote = this.$store.state.QuizModule.quiz.quotes[0]
            this.numOfQuotes = this.$store.state.QuizModule.quiz.quotes.length
        })
    },
    computed: {
        ...mapGetters(["quiz"]),
        successRate() {
            return (this.correctAnswersCount / this.numOfQuotes) * 100;
        }
    },
    components: {ProgressBar},
    methods: {
        ...mapActions(["fetchQuiz"]),
        updateNumOfUsers() {
            return this.$axios.put('/api/stats/update-num-of-users');
        },
        setUser() {
            localStorage.user = 'testUser';
        },
        getUser() {
            return localStorage.user;
        },
        destroyUser() {
            localStorage.removeItem('user');
            localStorage.removeItem('finished')
        },
        submitAnswer(answer) {
            this.loading = true;
            if (!this.selectedAnswer) {
                this.$axios.get(`api/quiz/check-answer?quote_id=${this.quote.id}`).then(res => {
                    this.selectedAnswer = answer;
                    this.rightAnswer = res.data;
                    this.updateAnswersStat(this.isRight(answer));
                });
            }

        },
        finish() {
            this.isFinished = true;
            if (localStorage.finished !== 1) {
                this.updateFinishedStatus(true)
            }
            localStorage.finished = 1;
        },
        updateAnswersStat(isRight) {
            if (isRight) {
                this.correctAnswersCount++;
            }
            return this.$axios.put('/api/stats/update-answers', {isRight: isRight})
        },
        updateFinishedStatus(isFinished) {
            if (isFinished) {
                return this.$axios.put('/api/stats/update-finished-status', {isFinished: isFinished})
            }
        },
        isRight(answer) {
            if (answer === 'no') {
                return this.rightAnswer.id !== this.randomAnswer.id
            }
            if (answer) {
                return this.rightAnswer.id === answer.id;
            }
            return this.rightAnswer.id === this.randomAnswer.id
        },
        setRandomAnswer() {
            this.randomAnswer = this.quote.answers[Math.floor(Math.random() * 4)];
        },
        nextQuote() {
            if (this.selectedAnswer) {
                this.quote = this.$store.state.QuizModule.quiz.quotes[this.quoteOrder];
                this.quoteOrder = this.quoteOrder + 1;
                this.setRandomAnswer();
                this.selectedAnswer = false;
            }
        },
        start() {
            this.resetApp()
        },
        resetApp() {
            this.quoteOrder = 1;
            this.quote = this.quiz.quotes[0];
            this.selectedAnswer = false;
            this.rightAnswer = false;
            this.isFinished = false;
            this.correctAnswersCount = 0;
            this.setRandomAnswer();
        }

    },
    watch: {
        mode() {
            this.resetApp()
        }
    }


}
</script>

<style scoped>

</style>
