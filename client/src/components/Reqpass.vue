<template>
  <div class="contemer">
    <div class="row" style="padding-top: 100px !important">
      <div class="col-4"></div>
      <div
        class="card p-0 col-6"
        style="height: 210px !important; width: 500px"
      >
        <div class="card-header bg-primary" style="color: white">
          Send Email Reset Password
        </div>
        <div class="card-body bground">
          <form @submit.prevent="onSubmit" autocomplete="off">
            <div class="form-group d-lg-inline row">
              <label for="exampleInputEmail1" class="col-sm-4 col-form-label"
                >Email address :</label
              >
              <input
                v-model="userData.email"
                type="email"
                name="email"
                class="form-control col-4"
                id="exampleInputEmail1"
                aria-describedby="emailHelp"
                placeholder="Enter email"
                :class="{ 'is-invalid': errors.email }"
              />
            </div>
            <br />
            <div class="float-end">
              <button type="submit" class="btn btn-primary">
                Send Password reset Email
              </button>
            </div>
          </form>
        </div>
      </div>
      <div class="col-4"></div>
    </div>
  </div>
</template>
  
  
    <script>
import Vue from "vue";
import axios from "axios";
import { toast } from "vue3-toastify";


export default {
   data() {
    return {
      userData: {
        email: "",
      },
      errors: {},
    };
  },
  methods: {
    onSubmit() {
      toast("Wet............!", {
        autoClose: 1000,
        position: toast.POSITION.BOTTOM_RIGHT,
      });
      axios.post("http://localhost:8000/api/sendPasswordResetLink", this.userData)
      .then((response) => {
          this.handleResponse(response.data);
        })
        .catch((error) => {
     
          toast(error.response.data.error, {
            autoClose: 1000,
            position: toast.POSITION.BOTTOM_RIGHT,
          });
        });
    },
    handleResponse(res) {

      toast(res.data, {
        autoClose: 1000,
        position: toast.POSITION.BOTTOM_RIGHT,
      });
      this.userData.email = "";
    },
  },
};
</script>
    
   
    <style scoped>
h1 {
  color: aqua;
}
.text-center {
  padding: 200px 500px;
}
.bground {
  background: rgb(2, 0, 36);
  background: linear-gradient(
    90deg,
    rgba(2, 0, 36, 1) 0%,
    rgba(221, 255, 222, 0.050945378151260545) 0%,
    rgba(221, 242, 218, 0.48792016806722693) 84%
  );
}
</style>
    
  
 