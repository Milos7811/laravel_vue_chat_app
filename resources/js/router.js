
import routesAuth from './routes/routesAuth'
import routesIndex from './routes/routesIndex'
import routesDashboard from './routes/routesDashboard'
import store from './store/index'
import Router from 'vue-router'
import Vue from 'vue'

Vue.use(Router)

const router = new Router ({
    mode: 'history',
    routes: [
        ...routesAuth,
        ...routesIndex,
        ...routesDashboard
    ],
})

router.beforeEach((to, from, next) => {
    if (to.matched.some((record) => record.meta.requiresAuth)) {
        // this route requires auth, check if logged in
        // if not, redirect to login page.

        let isAuthenticated = store.getters.authCheck ? store.getters.authCheck : config.authCheck

        if (!isAuthenticated) {
            next({
                name: 'SignIn',
                query: { redirect: to.fullPath },
            })
        } else {
            next()
        }
    } else {
        next() // make sure to always call next()!
    }
})

export default router
