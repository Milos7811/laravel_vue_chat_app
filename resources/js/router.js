
import routesAuth from './routes/routesAuth'
import routesIndex from './routes/routesIndex'
import Router from 'vue-router'
import Vue from 'vue'

Vue.use(Router)

const router = new Router ({
    mode: 'history',
    routes: [
        ...routesAuth,
        ...routesIndex,
    ],
})

export default router
