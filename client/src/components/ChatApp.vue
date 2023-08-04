<template>
  <div>
       <div class="row">
      <div class="col-4 pe-0">
        <nav class="nav flex-column bg-light" style="height: 761px !important">
          <a class="nav-link active" aria-current="page" href="#">Active</a>
          <a class="nav-link" href="#">Link</a>
          <a class="nav-link" href="#">Link</a>
          <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
          <a class="nav-link"  > <router-link to="/">Logout</router-link></a>
        
        </nav>
      </div>
      <div class="col-8 p-lg-0">
        <h3 class="list-group-item active bg-light" aria-current="true" style="color: blue; border: none;" >
          Chat App
        </h3>
        <ul class="list-group chat-container" ref="chatContainer">
          <chat v-for="value in chat.message" :key="value.index" color="danger" >
            {{ value }}
          </chat>
        </ul>
        <input type="text" class="form-control" id="txtMessage" placeholder="Type your Message..." v-model="message" @keyup.enter="send" />
      </div>
    </div>
  </div>
</template>


  <script>
  import { ref, onMounted, onUpdated } from 'vue';
  import Chat from './Chat.vue';
  import Pusher from "pusher-js";
  import {  mapGetters } from 'vuex';
  import Echo from "laravel-echo";
  import axios from "axios";
  Pusher.logToConsole = true;

export default {
    components: {  Chat },
  setup() {
    const chatContainer = ref(null);
    onMounted(() => {
      scrollToBottom();
    });

    onUpdated(() => {
      scrollToBottom();
    });

    function scrollToBottom() {
      if (chatContainer.value) {
        chatContainer.value.scrollTop = chatContainer.value.scrollHeight;
      }
    }

    return {
      chatContainer,
    };
  },

  data() {
    return {
      message: "",
      chat: {
        message: [],
      },
    };
  },
  methods: {
    ...mapGetters(['getToken']),
      pusher() {
        console.log(this.getToken())
        return new Pusher('d48f36eb19647382a1d0', {
          cluster: 'ap2',
          channelAuthorization: {
            endpoint: "http://127.0.0.1:8000/api/broadcasting/auth",
            auth: {
              headers: {
                'Authorization': 'Bearer ' + this.getToken()
              }
            }
          }
        });
      },
    async send() {
      if (this.message.length !== 0) {
         this.chat.message.push(this.message);

        this.message = "";

        var pusher = this.pusher();

        var channel = await pusher.subscribe('private-chat');

        channel.bind('pusher:subscription_succeeded', () =>{

        channel.trigger('client-my-event', JSON.stringify(this.message));

        })
        // axios.post('http://localhost:8000/api/send',this.message)
        //     .then(response => {
        //       this.handleResponse(response.data);
        //       this.message = "";
        //
        //     })
        //     .catch(error => {
        //       // Handle error
        //       this.handleError(error);
        //
        //     });
      }
    },
  },
  mounted() {
    Pusher.logToConsole = true;

  var pusher = this.pusher()

    var channel = pusher.subscribe('private-chat');
    channel.bind('my-event', function(data) {
      this.chat.message.push(JSON.parse(this.message));
    });
  //   Echo.private(`chat`)
  //       .listen('ChatEvent', (e) => {
  //         this.chat.message.push(e.message);
  //         // console.log(e);
  //       });
  }
};
</script>
  
 
  <style>
  h1 {
  color: aqua;
} 
li {
  text-align: left;
}
.list-group {
  overflow-y: scroll;
  height: 670px;

}
</style>
  