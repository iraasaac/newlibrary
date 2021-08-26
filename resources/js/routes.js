import home from "./vue/home"
import listbooks from "./vue/listbooks"
import createbook from "./vue/createbook"
import editbook from "./vue/editbook"
import auth from "./vue/auth"
import users from "./vue/users"
import edituser from "./vue/edituser"

export const routes = [
    {
        name: 'home',
        path: '/',
        component: home
    },
    {
        name: 'home2',
        path: '/index',
        component: home
    },
    {
        name: 'books',
        path: '/books',
        component: listbooks
    },
    {
        name: 'users',
        path: '/users',
        component: users
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
    },
    {
        name: 'login',
        path: '/login',
        component: auth
    },
    {
        name: 'edituser',
        path: '/edituser/:id',
        component: edituser
    }
];