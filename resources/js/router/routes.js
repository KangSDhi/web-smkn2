import HomePage from "../views/general/Home.vue";

const routes = [
    {
        path: "/",
        name: "Halaman Beranda",
        component: HomePage,
        meta: {
            title: "Halaman Beranda"
        }
    }
];

export default routes;