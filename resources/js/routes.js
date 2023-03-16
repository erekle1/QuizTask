import {createWebHistory, createWebHashHistory, createRouter} from "vue-router";

import Index from './Pages/Home/Index';
import Quiz from './Pages/Home/Quiz';
import Statistic from './Pages/Statistic/Index';
import App from './Layouts/App'


export const routes = [
    // {
    //     path: '/',
    //     component: App,
    // },
    {
        name: 'quiz',
        path: '/quiz',
        component: Quiz,
    },
    {
        name: 'statistic',
        path: '/statistics',
        component: Statistic
    },

];

const router = createRouter({
    mode: 'history',
    history: createWebHistory(),
    routes: routes,
});
// const router = new VueRouter({
//     mode: 'history',
//     history: createWebHistory(),
//     routes: routes
// })


export default router;
