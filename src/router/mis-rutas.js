import Vue from 'vue'
import Router from 'vue-router'


// Containers
const TheContainer = () => import('@/containers/TheContainer');
const Dashboard = () => import('@/views/Dashboard');
const Login = () => import('@/views/pages/Login');

const NotFoundComponent = () => import('@/views/pages/Page404');
const Unauthorized = () => import('@/views/pages/Page500');

const Pedidos = () => import ('@/panel/Pedidos');

Vue.use(Router)

const user = JSON.parse(localStorage.getItem('auth'));

const isAuth = (to, from, next) => {
    if (user && user.success) {
        next();
    } else {
        next({ name: 'Login' })
    }
}

const redirectIfAuth = (to, from, next) => {
    if (user && user.success) {
        next({ name: 'Home' })
    }
}

export default new Router({
  mode: 'history', // https://router.vuejs.org/api/#mode
  linkActiveClass: 'active',
  scrollBehavior: () => ({ y: 0 }),
  routes: configRoutes()
})


function configRoutes () {
    return [
      {
        path:'/login',
        name: 'Login',
        component: Login,
        beforeEnter:redirectIfAuth
      },
      {
        path: '/',
        redirect: '/pedidos',
        name: 'Home',
        component: TheContainer,
        beforeEnter:isAuth,
        children: [
          {
            path: 'pedidos',
            name: 'Pedidos',
            component: Pedidos,
            beforeEnter:isAuth
          },
        ]
      },
      { path: '*', name: '404', component: NotFoundComponent },
      { path: '/401', name: '401', component: Unauthorized }
  ]
}
