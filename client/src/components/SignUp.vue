<template>
    <div class="contemer">
  <div class="row" style="padding-top: 50px !important;">
    <div class="col-4"></div>
        <div class="card p-0 col-6" style="height: 650px !important; width: 500px;">
          <div class="card-header bg-primary" style="color:white"> Regster Here </div>
       <div class="card-body  bground" autocomplete="off">
              <form @submit.prevent="onSubmit" autocomplete="off" >
                <div class="form-group d-lg-inline row">       
                    <label for="exampleInputName">Name :</label>
                    <input type="text"  class="form-control col-4 " name="name" id="exampleInputName" placeholder="Enter name"  v-model="userData.name" required >
                    <div class="alert " v-if="error.name !== null" hidde  >
                      {{ error.name }}
                  </div>
                  </div>
         
                <div class="form-group d-lg-inline row">
                    <label for="exampleInputEmail1">Email address :</label>
                    <input type="email" class="form-control col-4 " name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" v-model="userData.email" required >
                    <div class="alert " v-if="error.email !== null" hidde  >
                      {{ error.email }}
                  </div>
                  </div>    
        
                <div class="form-group row d-lg-inline">
                    <label for="exampleInputPassword1">Password :</label>
                    <input v-bind:type="hide ? 'password' : 'text'" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" v-model="userData.password" required>
                   <a class="pi" @click="hide = !hide" :aria-label="'Hide password'" :aria-pressed="hide">
                       <i class="material-icons float-end">{{ hide ? 'visibility_off' : 'visibility' }}</i>
                   </a>
                  </div>
                <br><br>
                <div class="form-group row d-lg-inline">
                    <label for="exampleInputPassword2">Comform Password :</label>
                    <input v-bind:type="hide2 ? 'password' : 'text'" class="form-control"  name="password_confirmation" id="exampleInputPassword2" placeholder="Comform Password" v-model="userData.password_confirmation" required >
                    <a class="pi" @click="hide2 = !hide2" :aria-label="'Hide password'" :aria-pressed="hide2">
                      <i class="material-icons float-end">{{ hide2 ? 'visibility_off' : 'visibility' }}</i>
                    </a> 
                    <div class="alert " v-if="error.password !== null" hidde  >
                      {{ error.password }}
                  </div>
                  </div>
                <br>        
                <button type="submit" class="btn btn-primary float-lg-start">Register</button>
                <button type="button" class="btn btn-primary float-end"> <router-link to="/" style="color:white; text-decoration:none;">Sing In</router-link></button>
              </form>
        </div>
       </div>
       <div class="col-4"></div>
      </div>
      </div>
  
  </template>
  
  
    <script>
       import axios from 'axios';
       import { mapActions } from 'vuex';
  export default {
    data() {
    return {
      error:[],
        hide: true,
       hide2: true,   
    userData: {
      
        name:'',
        email: '',
        password:'',
        password_confirmation:'',
      },
    };
  },
  methods :{
    onSubmit(){
      console.log(this.userData);
      axios.post('http://localhost:8000/api/signup',this.userData)
      .then(response => {
        this.handleResponse(response.data);

      })
      .catch(error => {
      // Handle error
      this.handleError(error);
      
    });
  },
    handleError(error) {
      if (error.response) {
        this.error = error.response.data.errors; // Update the 'error' property based on the nested property
      } else {
        this.error = "An unknown error occurred."; // Default error message when the structure is not as expected
      }
},
...mapActions(['handleToken']),
    handleResponse(data) {
      // Assuming 'data' contains the access_token
      this.handleToken(data.access_token);
      // router
      this.$router.push('/chatapp')
    },
  }
  };
  </script>
    
   
    <style scoped>
  h1 {
    color: aqua;
  }
  .text-center {
    padding: 200px 500px;
  }
  .bground{
      background: rgb(2,0,36);
  background: linear-gradient(90deg, rgba(2,0,36,1) 0%, rgba(221,255,222,0.050945378151260545) 0%, rgba(221,242,218,0.48792016806722693) 84%);
  }
  .pi{
 position: relative;
 text-decoration: none;
 padding-top:35px ;
 color:black;

}
  </style>
    