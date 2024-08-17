import { createRouter, createWebHistory } from "vue-router";

import Dashboard from "../components/Dashboard.vue";
import Login from "../components/auth/login.vue";
import Register from "../components/auth/register.vue";
import Password from "../components/auth/password.vue";

import EmployeeList from "../components/employee/index.vue";
import EmployeeCreate from "../components/employee/create.vue";
import EmployeeEdit from "../components/employee/edit.vue";

import SupplierList from "../components/supplier/index.vue";
import SupplierCreate from "../components/supplier/create.vue";
import SupplierEdit from "../components/supplier/edit.vue";

import CategoryList from "../components/category/index.vue";
import CategoryCreate from "../components/category/create.vue";
import CategoryEdit from "../components/category/edit.vue";


const routes = [
    {
        path: "/dashboard",
        name: "Dashboard",
        component: Dashboard,
        meta: { requiresAuth: true },
    },

    {
        path: "/",
        name: "Login",
        component: Login,
    },

    {
        path: "/register",
        name: "Register",
        component: Register,
    },
    {
        path: "/password",
        name: "Password",
        component: Password,
    },
    {
        path: "/employee-list",
        name: "EmployeeList",
        component: EmployeeList,
        meta: { requiresAuth: true },
    },
    {
        path: "/employee-create",
        name: "EmployeeCreate",
        component: EmployeeCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/employee-edit/:id",
        name: "EmployeeEdit",
        component: EmployeeEdit,
        meta: { requiresAuth: true },
    },
    {
        path: "/supplier-list",
        name: "SupplierList",
        component: SupplierList,
        meta: { requiresAuth: true },
    },
    {
        path: "/supplier-create",
        name: "SupplierCreate",
        component: SupplierCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/supplier-edit/:id",
        name: "SupplierEdit",
        component: SupplierEdit,
        meta: { requiresAuth: true },
    },
    {
        path: "/category-list",
        name: "CategoryList",
        component: CategoryList,
        meta: { requiresAuth: true },
    },
    {
        path: "/category-create",
        name: "CategoryCreate",
        component: CategoryCreate,
        meta: { requiresAuth: true },
    },
    {
        path: "/category-edit/:id",
        name: "CategoryEdit",
        component: CategoryEdit,
        meta: { requiresAuth: true },
    }
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

router.beforeEach((to, from, next) => {
    const token = localStorage.getItem("token");
    if (to.matched.some((record) => record.meta.requiresAuth) && !token) {
        next("/");
    } else {
        next();
    }
});

export default router;
