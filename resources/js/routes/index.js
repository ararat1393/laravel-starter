import VueRouter from 'vue-router';
import Home from "../src/components/Home";

const routes = [
    {
        name:'Home',
        path:'/',
        component:Home
    }
];
const router = new VueRouter({
    history: true,
    mode: 'history',
    routes,
});

router.beforeEach((to, from, next) => {
    if (!to.matched.length) {
        next(from.path);
    } else {
        next();
    }
});

export default router
