const state = {
    quiz: [],
}
const mutations = {
    setQuiz: (state, quiz) => (
        state.quiz = quiz
    ),
}

const getters = {
    quiz: state => state.quiz,
};

const actions = {
    async fetchQuiz({commit}) {
        await axios.get('/api/quiz').then(res => {
            commit("setQuiz", res.data)
        })
    },

}


export default {
    actions,
    getters,
    mutations,
    state,
}
