import listbooks from "./vue/listbooks"
import createbook from "./vue/createbook"
import editbook from "./vue/editbook"

export const routes = [
    {
        name: 'home',
        path: '/',
        component: listbooks
    },
    {
        name: 'home',
        path: '/index',
        component: listbooks
    },
    {
        name: 'books',
        path: '/books',
        component: listbooks
    },
    {
        name: 'createbook',
        path: '/createbook',
        component: createbook
    },
    {
        name: 'editbook',
        path: '/editbook/:id',
        component: editbook
    }
];