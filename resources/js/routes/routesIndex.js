const routesIndex = [
    {
        name: 'HomePage',
        path: '/',
        component: () => import(/* webpackChunkName: "chunks/homepage" */ '../views/FrontPage/HomePage'),

    }

]

export default routesIndex
