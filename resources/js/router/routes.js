import HomePage from "../views/general/Home.vue";
import AuthPage from "../views/auth/Auth.vue";

const routes = [
    {
        path: "/",
        name: "Halaman Beranda",
        component: HomePage,
        meta: {
            title: "Halaman Beranda"
        }
    },
    {
        path: "/auth",
        name: "Halaman Login",
        component: AuthPage,
        meta: {
            title: "Halaman Login"
        }
    }
];

export default routes;