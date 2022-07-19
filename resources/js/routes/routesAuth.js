const routesAuth = [
    {
        name: 'SignIn',
        path: '/sign-in',
        component: () =>import(/* webpackChunkName: "chunks//sign-in" */ '../views/Auth/SignIn'),

    },
    {
        name: 'SignUp',
        path: '/sign-up',
        component: () =>import(/* webpackChunkName: "chunks/sign-up" */ '../views/Auth/SignUp'),

    },
]

export default routesAuth
