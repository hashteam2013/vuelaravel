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
    <div class="row justify-content-center mb-4">
        <div class="col-auto">
            <h1>Login</h1>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <form id="login-form-id">
                <div class="card">
                <div class="card-body">
                    <div class="row gx-2">
                        <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Email</label>
                            <input type="text" name="email" v-model="email" class="form-control" id="emailid" placeholder="Name">
                        
                        </div>
                        </div>
                        <div class="col-12">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">Password</label>
                            <input type="password" name="password" v-model="password" class="form-control" id="nameid" placeholder="Name">
                    
                        </div>
                        </div>
                    </div> 
                        <div class="row">
                        <div class="col-12 text-right">
                        <button class="btn btn-primary btn-md w-100" type='button' @click="save($event)">Login</button>
                        </div>
                        </div> 
                    </div> 
                </div>
            </form>  
        </div>
    </div>          
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
      email:"",
      password:""
   }
 },
  validations: {
           email:{required},
           password:{required},
        },
  methods:{
   async save(e){
      e.preventDefault();
      self=this;
    //    const result = await this.v$.$validate()
    const  result=false
      if (result) {
        return false;
      }
      else{
        let formdata= new FormData(document.getElementById('login-form-id'));
               axios.post('http://127.0.0.1:8000/api/login',formdata ,{
          headers: {
                 'Content-Type': 'multipart/form-data'
                }
            }
           ).then(function(response){
             console.log(response);
             if(response.data.status=='validErr'){
                   if(response.data.errors.email){
                       toast.error(response.data.errors.email[0], {
                        position: toast.POSITION.TOP_RIGHT,
                      });
                   }
                   if(response.data.errors.password){
                       toast.error(response.data.errors.password[0], {
                        position: toast.POSITION.TOP_RIGHT,
                      });
                   }
             }
             if(response.data.status=='success'){
                console.log(response.data.data);
                 localStorage.setItem('laravelvuetoken',response.data.data);
                  toast.success(response.data.message, {
                      position: toast.POSITION.TOP_RIGHT,
                      type:'success'
                    });
                self.$router.push('/list');
             }
             if(response.data.status=='faliure'){
                localStorage.removeItem("laravelvuetoken");
                  toast.error(response.data.message, {
                  position: toast.POSITION.TOP_RIGHT,
                });
             }

           }).catch(function(response){
            toast.error(response.data.message, {
                  position: toast.POSITION.TOP_RIGHT,
                });

           });
      }
   }
}
}
 </script>
    
