<template>
  <div class="contemer">
<div class="row" style="padding-top: 100px !important;">
  <div class="col-4"></div>
      <div class="card p-0 col-md-6 col-sm-12" style="height: 506px !important; width: 500px;">
        <div class="card-header bg-primary" style="color:white"> Login Here </div>
     <div class="card-body  bground">
            <form  @submit.prevent="onSubmit" autocomplete="off">
              <div class="alert alert-danger" v-if="error !== null" hidde  >
                {{ error }}
              </div>
                    <div class="form-group row">
                            <label for="exampleInputEmail1" class="col-sm-4 col-form-label">Email address :</label>
                            <input type="email" class="form-control col-4 " name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  v-model="userData.email" required >
                        </div>
                        <br>
                        <div class="form-group row">
                            <label for="exampleInputPassword1" class="col-sm-4 col-form-label">Password :</label>
                            <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Password" v-model="userData.password" required >
<!--                            <a class="pi" @click="hide = !hide" :aria-label="'Hide password'" :aria-pressed="hide">-->
<!--                              <i class="material-icons float-end">{{ hide ? 'visibility_off' : 'visibility' }}</i>-->
<!--                          </a>-->
                          </div>
                        <br>
                        <div class="form-check  float-lg-start">
                             <label class="form-check-label text-danger" for="exampleCheck1">Remember me</label>
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            
                        </div>
                        <br><br>
                        <div class=" float-lg-start">
                          <button type="submit" class="btn btn-primary">Sign in</button>
                        </div>
                        <div class="float-end"> 
                          <button type="button" class="btn btn-primary "> <router-link to="/signup" style="color:white; text-decoration:none;">Sing Up</router-link></button>
                        </div>
                        <br><br>
                        <small style="float: right">
                        <a><router-link to="/request-password-reset">Rest password </router-link></a>
                      </small>
                     
                       
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
 
      error:null,
      hide: true,  
    userData: {
         email: '',
        password:'',
      },
    };
  },
  methods: {
   
    
    onSubmit(){

    axios.post('http://localhost:8000/api/login',this.userData)
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
        this.error = error.response.data.error; // Update the 'error' property based on the nested property
      } else {
        this.error = "An unknown error occurred."; // Default error message when the structure is not as expected
      }
},
...mapActions(['handleToken']),
    handleResponse(data) {
      // Assuming 'data' contains the access_token
      this.handleToken(data.access_token);
      // router
      this.$router.push('/chatapp');
 
    },
},

}
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
 position: absolute;
 text-decoration: none;
 padding-top:47px ;
 color:black;
}
</style>
  

