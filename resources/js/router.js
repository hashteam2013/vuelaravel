import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import EventAdd from './components/EventAdd.vue';
import EventList from './components/EventList.vue';
import EventEdit from './components/EventEdit.vue';
import Login from './components/Auth/Login.vue';
const routes = [
  

  {
    path:'/',
    name:'Login',
    component:Login,
    
 },
 {
  path:'/list',
  name:'EventList',
  component:EventList,
  beforeEnter: (to, from, next) => {
    guard(to, from, next);
  }
},
  {
     path:'/add',
     name:'events',
     component:EventAdd,
     beforeEnter: (to, from, next) => {
      guard(to, from, next);
    }
  },
 {
  path:'/edit/:id',
  name:'eventsedit',
  component:EventEdit,
  beforeEnter: (to, from, next) => {
    guard(to, from, next);
  }
}
];
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
  function guard(to, from, next){
     
     if(localStorage.getItem('laravelvuetoken') && (localStorage.getItem('laravelvuetoken') !=undefined || localStorage.getItem('laravelvuetoken') !="undefined") ){
       return next();
     }
      router.push('/');
  }
export default router;
