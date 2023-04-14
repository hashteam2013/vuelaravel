<style>
.card{
    border-radius: 5px;
    border: none;
    margin-bottom: 15px;
    box-shadow: 0 0 20px 4px #0000000f;
}
.card .form-control {
    border: 1px solid #e0e0e0;
    padding: 7px 14px;
    height: 45px;
    box-shadow: none;
    color: #333333;
    border-radius: 5px;
}
textarea.form-control {
    height: auto !important;
}
</style>

<template>
  <div class="page py-5">
  <div class="container">
    <div class="row mb-2">
      <div class="col">
        <h3>Add Event</h3> 
      </div>
      <div class="col-auto">

      </div>
    </div>
    <div class="row mb-2">
      <div class="col-auto">
        <button type="button" @click="list" class="btn">
          <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
          Back
        </button>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12">

      </div>
    </div>
    

    <form id="event-form-id">
    <div class="card mt-4">
      <div class="card-body">
        <div class="row gx-2">
        <div class="col-4">
          <div class="form-group">
            <label for="exampleFormControlInput1">Name</label>
            <input type="text" name="event_name" v-model="event_name" class="form-control" id="nameid" placeholder="Name">
           <span class="text-danger" v-if="v$.event_name.$error"> {{ v$.event_name.$errors[0].$message }} </span>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label for="typeid">Type</label>
            <select class="form-control" name="type_id" v-model="selected" id="typeid">
             <option v-for="(option,index) in type_id" :value="option.value" v-bind:key="index">
                       {{ option.text }}
              </option>
            </select>
          <span class="text-danger" v-if="v$.selected.$error"> {{ v$.selected.$errors[0].$message }} </span>
          </div>
        </div>
        <div class="col-4">
          <div class="form-group">
            <label for="imageid">Image</label>
            <input type="file" class="form-control"  name="image" id="imageid" placeholder="Image">
            
          </div>
        </div>
        <div class="col-12">
          <div class="form-group">
            <label for="exampleFormControlSelect1">Description</label>
            <textarea class="form-control" v-model="description" name="description"  rows="5"></textarea>
           <span class="text-danger" v-if="v$.description.$error"> {{ v$.description.$errors[0].$message }} </span>
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-12 text-right">
          <button class="form-control  btn btn-primary w-auto text-white" type='button' @click="save($event)">Save</button>
          </div>
        </div>
      </div>
    </div>
    </form>
  <FlashMessage position="left top" time="10000" strategy="single" group="hints"/>
  </div>
  </div>

</template>
<script>
import { useVuelidate } from '@vuelidate/core'
import axios from "axios";
import { required, email } from '@vuelidate/validators'
import { toast } from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';

 export default{
 data(){
  return {  
    event_name:"",
    selected:'',
    type_id:[
            {text:"Please select event type",value:''},
            { text: 'Concert', value: 1 },
            { text: 'Charity', value: 2 },
            { text: 'Product', value: 3 }
             
            ],
    description:"",
    image:""
   }
 },
  setup () {
    return { v$: useVuelidate() }
  },
 mount(){},
 validations: {
           event_name:{required},
           selected:{required},
           description:{required},

        },
 methods:{
   async save(e){
      e.preventDefault();
      self=this;
       const result = await this.v$.$validate()
      
      if (!result) {
        return false;
      }
      else{

        let formdata= new FormData(document.getElementById('event-form-id'));
               axios.post('http://127.0.0.1:8000/api/event/create',formdata ,{
          headers: {
                 'Content-Type': 'multipart/form-data'
                }
            }
           ).then(function(response){
             console.log(response);
             if(response.data.status=='validErr'){
                   if(response.data.errors.event_name){
                       toast.error(response.data.errors.event_name[0], {
                        position: toast.POSITION.TOP_RIGHT,
                      });
                   }
                   if(response.data.errors.type_id){
                       toast.error(response.data.errors.type_id[0], {
                        position: toast.POSITION.TOP_RIGHT,
                      });
                   }
                   if(response.data.errors.description){
                       toast.error(response.data.errors.description[0], {
                        position: toast.POSITION.TOP_RIGHT,
                      });
                   }                   
                 
             }
             if(response.data.status=='success'){
                  toast.success(response.data.message, {
                      position: toast.POSITION.TOP_RIGHT,
                      type:'success'
                    });
                        self.$router.push({ path: '/' });
             }

           }).catch(function(response){
            toast.error(response.data.message, {
                  position: toast.POSITION.TOP_RIGHT,
                });

           });
      }
      
 },
 list(){
    this.$router.push({ path: '/' });
 },
  edit(){
    this.$router.push({ path: 'edit' });
 },

}
 }
</script>
