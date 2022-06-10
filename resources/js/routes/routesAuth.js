const routesAuth = [
    {
        name: 'SignIn',
        path: '/sign-in',
        component: () =>
            import(/* webpackChunkName: "chunks/successfully-email-verified" */ '../views/Auth/SignIn'),

    },
    {
        name: 'SignUp',
        path: '/sign-up',
        component: () =>
            import(/* webpackChunkName: "chunks/successfully-email-verified" */ '../views/Auth/SignUp'),

    },
]

export default routesAuth
