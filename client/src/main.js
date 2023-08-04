import { createApp } from "vue";
import { createStore } from "vuex";
import App from "./App.vue";
import routes from "./router";
import { createRouter, createWebHashHistory } from "vue-router";
import Vue3Toasity from 'vue3-toastify';
import 'vue3-toastify/dist/index.css';
// import JarwisServices from './services/jarwis';
import tokens from './services/token';
import authsev from './services/authsev';

const token_store = createStore(tokens);
const auth_store = createStore(authsev);

const router = createRouter({
  // 4. Provide the history implementation to use. We are using the hash history for simplicity here.
  history: createWebHashHistory(),
  routes, // short for `routes: routes`
});

const app = createApp(App);



app.use(token_store);
// app.use(auth_store);
app.use(router);
app.use(Vue3Toasity,
  {
    autoClose: 3000,
    // ...
  })

app.mount("#app");
