
// require('./bootstrap');

// import { createApp } from 'vue';

// import chat from './components/Chat.vue';

// Vue.component("video-chat", require("./components/VideoChat.vue").default);

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);


// const app = createApp({});

// app.component('chat', chat);


// // app.mount('#app');



// require('./bootstrap');
import './bootstrap';


import { createApp } from 'vue';
// import 'laravel-datatables-vite';

// Vue.component("agora-chat", require("./components/AgoraChat.vue").default);
// import Chat from './components/Chat.vue';
// import ExampleComponent from './components/ExampleComponent.vue';

// const app = createApp({});

// app.component('chat', Chat);
// app.component('example-component', ExampleComponent);

// app.mount('#app');
const channel = Echo.channel('chat');
console.log('Chat Channel');
console.log(channel);