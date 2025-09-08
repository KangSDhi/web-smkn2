import HomePage from "../views/general/Home.vue";
import FacilityPage from "../views/general/Facility.vue";
import Article from "../views/general/Article.vue";
import AuthPage from "../views/auth/Auth.vue";
import DashboardAuthor from "../views/author/Dashboard.vue";
import IndexArticleAuthor from "../views/author/article/Index.vue"
import AddArticleAuthor from "../views/author/article/AddArticle.vue";
import EditArticleAuthor from "../views/author/article/EditArticle.vue";
import ViewArticleAuthor from "../views/author/article/ViewArticle.vue";

const routes = [
    {
        path: "/",
        name: "Home Page",
        component: HomePage,
    },
    {
        path: "/fasilitas",
        name: "Facility Page",
        component: FacilityPage,
    },
    {
        path: "/berita/:slug",
        name: "Article Page",
        component: Article,
    },
    {
        path: "/auth",
        name: "Login Page",
        component: AuthPage,
    },
    {
        path: "/author/",
        children: [
            {
                path: "dashboard",
                name: "Dashboard Author Page",
                component: DashboardAuthor,
            },
            {
                path: "article/",
                children: [
                    {
                        path: "",
                        name: "Article Author Page",
                        component: IndexArticleAuthor,
                    },
                    {
                        path: "add",
                        name: "Add Article Author Page",
                        component: AddArticleAuthor,
                    },
                    {
                        path: "edit/:slug",
                        name: "Edit Article Author Page",
                        component: EditArticleAuthor,
                    },
                    {
                        path: "view/:slug",
                        name: "View Article Author Page",
                        component: ViewArticleAuthor,
                    }
                ]
            }
        ]
    }
];

export default routes;
