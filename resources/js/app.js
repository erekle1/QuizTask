import {createApp} from 'vue'

require('./bootstrap')
import Index from './Pages/Home/Index'
import axios from 'axios'
import router from './routes'
import {createStore} from 'vuex'
import QuizModule from "./Store/modules/QuizModule";

const app = createApp(Index)

app.config.globalProperties.$axios = axios;
app.use(router)
let store = createStore({
    modules: {
        QuizModule
    }
})
app.use(store)


app.mount('#app')
