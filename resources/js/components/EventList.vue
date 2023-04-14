<template>
<div class="page py-5">
  <div class="container">
    <div class="row justify-content-end mb-4">
      <div class="col">
        <h3>Event List</h3>
      </div>
      <div class="col-auto">
        <button type="button" @click="add" class="btn btn-sm btn-primary">Add</button>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <EasyDataTable
              :headers="headers"
              :items="items"
              @click-row="Edit"
            />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</template> 
<script>
import  {ClickRowArgument } from "vue3-easy-data-table";
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
 import axios from "axios";
 export default{
 data () {
      return {
        headers: [
          { text: "id", value: "id" },
          { text: "Event Name", value: "event_name" },
          { text: "Description", value: "description" },
          { text: "Event Type", value: "eventtype.name" },   
        ],
        items: [],
      }
    },
  
mounted(){
      self=this;
      var  token =  localStorage.getItem('laravelvuetoken');
    axios.get('http://127.0.0.1:8000/api/event/list', { headers: {"Authorization" : `Bearer ${token}`}} )
          .then(function(response){
            console.log(response);
              if(response.data.status=='faliure'){
               // localStorage.removeItem("laravelvuetoken");
                  toast.error(response.data.message, {
                  position: toast.POSITION.TOP_RIGHT,
                });
                self.$router.push('/');
             }
             self.items=response.data.data; 
          })
          .catch(function(response){
           toast.error(response.data.message, {
                  position: toast.POSITION.TOP_RIGHT,
                });
         //  localStorage.removeItem('laravelvuetoken');
          });
},
methods:{
    
    Edit(ClickRowArgument){
        console.log(ClickRowArgument);
        this.$router.push('/edit/'+ClickRowArgument.id);
    },
     add(){
         this.$router.push('/add');
     }
}
 }

</script>

