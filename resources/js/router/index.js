import {createWebHistory, createRouter} from "vue-router";

import Home from '../pages/Home';
import Register from '../pages/Register';
import Login from '../pages/Login';

import Transportadoras from '../components/Transportadoras';
import AddTransportadora from '../components/AddTransportadora';
import EditTransportadora from '../components/EditTransportadora';

export const routes = [
    {
        name: 'home',
        path: '/',
        component: Home
    },
    {
        name: 'register',
        path: '/register',
        component: Register
    },
    {
        name: 'login',
        path: '/login',
        component: Login
    },
    {
        name: 'transportadora',
        path: '/transportadora',
        component: Transportadoras
    },
    {
        name: 'addtransportadora',
        path: '/transportadora/add',
        component: AddTransportadora
    },
    {
        name: 'edittransportadora',
        path: '/transportadora/edit/:id',
        component: EditTransportadora
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes: routes,
});

export default router;
