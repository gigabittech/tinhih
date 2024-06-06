<template lang="">
    <div class="dropdown-menu dropdown-menu-end pt-0" style="width:300px !important; background: #051821">

        <div class="dropdown-header py-2" style="background: #142f2f">
            <div class="fw-semibold">Notifications</div>
        </div>

        <p style=" color: #607274" class="ps-3 pb-0 mb-0 mt-2"> </p>
        <a class="dropdown-item text-success mt-2" style="background: rgb(11, 26, 26)" href="{{ route('notification.markRead') }}">
            Mark all as read
        </a>
        <p style="padding: 0 5px 5px 15px; margin-top: 10px;" class="fs-10 text-center mb-0">
        You have no Notification</p>

</div>
</template>



<script>
  import { reactive, ref, onMounted, onUpdated } from 'vue';
  import axios from 'axios';

  export default {
	props: ['user'],
	setup(props) {
	  let unreadNotifications = ref([]);
	  let newNotification = ref('');
  
	  onMounted(() => {
		fetchNotification();
	  });
  
	  onUpdated(() => {
		scrollBottom();
	  });
  
	  Echo.private('chat-channel')
		.listen('SendMessage', (e) => {
		  messages.value.push({
			message: e.message.message,
			user: e.user
		  });
		});
  
	  const fetchNotification = async () => {
		axios.get('/messages').then(response => {
		  messages.value = response.data;
		});
	  };
  
	  const addMessage = async () => {
		let user_message = {
		  user: props.user,
		  message: newMessage.value
		};
  
		messages.value.push(user_message);
		axios.post('/messages', user_message).then(response => {
		  console.log(response.data);
		});
  
		newMessage.value = '';
	  };
  
	  const scrollBottom = () => {
		if (messages.value.length > 1) {
		  let el = hasScrolledToBottom.value;
		  el.scrollTop = el.scrollHeight;
		}
	  };
  
	  return {
		messages,
		newMessage,
		addMessage,
		fetchMessages,
		hasScrolledToBottom
	  };
	}
  };

</script>