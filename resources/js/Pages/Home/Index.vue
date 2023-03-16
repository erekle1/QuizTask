<template>
    <Nav/>
    <main class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <router-view/>
    </main>
<!--        <div class="ml-6">-->
<!--            <h2 class="text-2xl font-bold leading-7 text-gray-900 text-center sm:text-3xl sm:truncate ml-6 mt-10">-->
<!--                Quiz - {{ quiz.name }}-->
<!--            </h2>-->
<!--            <quote />-->
<!--        </div>-->

<!--        <div  class="flex justify-center items-center">-->
<!--            <div class="animate-spin rounded-full h-20 2-20 border-t-2 border-b-2 border-gray-500"></div>-->
<!--        </div>-->


</template>

<script>
import Quote from "../../Components/Quote";
import Nav from "./../../Components/Nav";

import {mapState} from "vuex";

export default {
    name: "Index",
    components: {Quote, Nav},
    data() {
        return {
            mode: 1,
        }
    },
    computed: mapState({
        quiz: state => state.QuizModule.quiz,
    })
}
</script>

<style scoped>

</style>
