import Vue from 'vue';
import VueRouter from 'vue-router';

Vue.use(VueRouter);

// importo i componenti che uso nelle rotte
import Home from './pages/Home';
import About from './pages/About';
import ContactUs from './pages/ContactUs';
import Blog from './pages/Blog';
import SinglePost from './pages/SinglePost';
import NotFound from './pages/NotFound';

const router = new VueRouter({
    mode: 'history',  //man mano che mi sposto tra le pagine, usa solo il path che definisco nelle rotte. Di default aggiunge '#'
    routes : [
        {
            path: '/',
            name: 'home',
            component: Home
        },
        {
            path: '/blog',
            name: 'blog',
            component: Blog
        },
        {
            path: '/about',
            name: 'about',
            component: About
        },
        {
            path: '/contact-us',
            name: 'contact-us',
            component: ContactUs
        },
        {
            path: '/blog/:slug',
            name: 'single-post',
            component: SinglePost
        },
        {
            path: '*',
            name: 'not-found',
            component: NotFound
        }

    ] // short for `routes: routes`
  });

  export default router;