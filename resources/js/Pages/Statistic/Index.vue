<template>
    <div class="grid grid-cols-4 gap-4">
        <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 mt-10">
            <h4 class="text-gray-800 text-center">Total Number Of Users</h4>
            <div class="text-gray-800 text-center">
                {{statistic.num_of_users}}
            </div>
        </div>
        <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 mt-10">
            <h4 class="text-gray-800 text-center">Percentage Of Users Who Finished The Game</h4>
            <div class="text-gray-800 text-center">
                {{statistic.finished_percentage}}
            </div>
        </div>
        <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 mt-10">
            <h4 class="text-gray-800 text-center">Percentage Of Correct Answers</h4>
            <div class="text-gray-800 text-center">
                {{statistic.correct_answers}}
            </div>
        </div>
        <div class="bg-white ring ring-gray-800 ring-offset-1 p-6 mt-10">
            <h4 class="text-gray-800 text-center">Percentage Of Incorrect Answers</h4>
            <div class="text-gray-800 text-center">
                {{statistic.incorrect_answers}}
            </div>
        </div>


    </div>
</template>

<script>
import App from "../../Layouts/App";

export default {
    name: "Index",
    components: {App},
    data() {
        return {statistic: {}}
    },
    created() {
        this.$axios.get('/api/stats/').then(res => {
            this.statistic = res.data
        })
    }
}
</script>

<style scoped>

</style>
