<template>
    <div class="container">
        <div class="row">
          <div class="col-12" >
            <div class="row">
              <router-view></router-view>   
            </div> 
        </div>  
      </div> 
    </div>
</template>

<script>
import Vue from 'vue';
import ChatApp from './components/ChatApp.vue';
import Login from './components/Login.vue';


export default {

  components: { Login, ChatApp },

    };
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
  margin-top: 50px;
  
}

</style>
