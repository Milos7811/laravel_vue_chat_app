const routesDashboard = [
    {
        name: 'Dashboard',
        path: '/dashboard',
        component: () => import(/* webpackChunkName: "chunks/dashbaord" */ '../views/Dashboard/Dashboard'),
        meta: {
            requiresAuth: true,
        },
    }
]

export default routesDashboard
