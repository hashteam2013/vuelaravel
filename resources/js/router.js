import { createRouter, createWebHistory } from 'vue-router';
import Home from './components/Home.vue';
import EventAdd from './components/EventAdd.vue';
import EventList from './components/EventList.vue';
import EventEdit from './components/EventEdit.vue';
const routes = [
  
  {
    path:'/',
    name:'eventslist',
    component:EventList
 },
  {
     path:'/add',
     name:'events',
     component:EventAdd
  },
 {
  path:'/edit/:id',
  name:'eventsedit',
  component:EventEdit
}
];
const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})
export default router;
