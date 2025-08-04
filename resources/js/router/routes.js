import HomePage from "../views/general/Home.vue";
import AuthPage from "../views/auth/Auth.vue";
import DashboardAuthor from "../views/author/Dashboard.vue";
import IndexArticleAuthor from "../views/author/article/Index.vue"
import AddArticleAuthor from "../views/author/article/AddArticle.vue";

const routes = [
    {
        path: "/",
        name: "Home Page",
        component: HomePage,
        meta: {
            title: "Halaman Beranda"
        }
    },
    {
        path: "/auth",
        name: "Login Page",
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
                name: "Dashboard Author Page",
                component: DashboardAuthor,
                meta: {
                    title: "Halaman Dashboard Author"
                }
            },
            {
                path: "article/",
                children: [
                    {
                        path: "",
                        name: "Article Author Page",
                        component: IndexArticleAuthor,
                        meta: {
                            title: "Halaman Artikel Author"
                        }
                    },
                    {
                        path: "add",
                        name: "Add Article Author Page",
                        component: AddArticleAuthor,
                        meta: {
                            title: "Halaman Membuat Artikel"
                        }
                    }
                ]
            }
        ]
    }
];

export default routes;
