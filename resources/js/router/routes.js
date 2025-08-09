import HomePage from "../views/general/Home.vue";
import AuthPage from "../views/auth/Auth.vue";
import DashboardAuthor from "../views/author/Dashboard.vue";
import IndexArticleAuthor from "../views/author/article/Index.vue"
import AddArticleAuthor from "../views/author/article/AddArticle.vue";
import ViewArticleAuthor from "../views/author/article/ViewArticle.vue";

import Untitled0 from "../views/general/dummy/Untitled0.vue";
import Untitled1 from "../views/general/dummy/Untitled1.vue";

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
        path: "/berita/smk-negeri-2-bojonegoro-gelar-workshop-dan-review-kurikulum-satuan-pendidikan",
        name: "SMK Negeri 2 Bojonegoro Gelar Workshop dan Review Kurikulum Satuan Pendidikan",
        component: Untitled0,
        meta: {
            title: "SMK Negeri 2 Bojonegoro Gelar Workshop dan Review Kurikulum Satuan Pendidikan"
        }
    },
    {
        path: "/berita/smk-negeri-2-bojonegoro-popkab-bojonegoro",
        name: "SMK Negeri 2 Bojonegoro Popkab Bojonegoro",
        component: Untitled1,
        meta: {
            title: "SMK Negeri 2 Bojonegoro Popkab Bojonegoro"
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
                    },
                    {
                        path: "view/:slug",
                        name: "View Article Author Page",
                        component: ViewArticleAuthor,
                        meta: {
                            title: "Halaman View Artikel"
                        }
                    }
                ]
            }
        ]
    }
];

export default routes;
