import HomePage from "../views/general/Home.vue";
import AuthPage from "../views/auth/Auth.vue";
import DashboardAuthor from "../views/author/Dashboard.vue";
import AddPostAuthor from "../views/author/posts/AddPost.vue";

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
    },
    {
        path: "/author/",
        children: [
            {
                path: "dashboard",
                name: "Dashboard Author",
                component: DashboardAuthor,
                meta: {
                    title: "Halaman Dashboard Author"
                }
            },
            {
                path: "post/add",
                name: "Add Post Author",
                component: AddPostAuthor,
                meta: {
                    title: "Halaman Post Author"
                }
            }
        ]
    }
];

export default routes;