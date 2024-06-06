@extends('admin.layout.template')
@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid h-100vh p-5 bg-black" id="app">
        <div class="row justify-content-center">
            <div class="col-lg-8 bg-dark1 p-5">
                <div class="chat card" id="app">
                    <div class="d-none">@{{ shouldPalyedSound }}</div>

                    <div class="scrollable card-body mb-1" ref="hasScrolledToBottom">
                        {{-- <div v-for="message in messages" :key="message.id" class="message" --}}
                        {{--                           :class="{ 'message-receive': user.id !== message.user.id, 'message-send': user.id === message.user.id }" --}}
                        {{--                      > --}}
                        {{--                        <p> --}}
                        {{--                          <strong class="primary-font"> @{{ message.user }}:</strong> --}}
                        {{--                          @{{ message.message }} test --}}
                        {{--                        </p> --}}
                        {{--      
                                        </div> --}}
                        <div v-for="m in messages" :key="m.id" ref="messageContainer">
                            <div class="row">
                                <div class="col-lg-6">
                                    <p v-if="currentUser" class="pb-2 "><span class="text-primary">
                                            @{{ m.user.name }}:</span>
                                        @{{ m.message }}</p>
                                    </p>
                                </div>
                                {{--  --}}
                            </div>

                        </div>
                    </div>

                    <div class="chat-form input-group profile-field">
                        <input id="btn-input" type="text" name="message" class="form-control input-sm message-"
                            placeholder="Type your message here..." v-model="newMessage" @keyup.enter="addMessage"
                            style="height: 40px;" autofocus ref="messageInput">
                        <span class="input-group-btn" style="cursor: pointer">
                            <img src="{{ asset('admin/assets/img/message.png') }}" height="40px" id="btn-chat"
                                @click="addMessage" alt="Send Message">
                        </span>
                    </div>
                </div>
            </div>
        </div>



    </div>
@endsection


@section('extra-script')
    {{-- Module works --}}
    <script src="{{ mix('js/app.js') }}"></script>
    <script>
        const app = {
            data() {
                return {
                    // {{ env('APP_URL') }}/
                    // rootUrl: 'http://localhost/gigabit/tinhih/private-panel',
                    rootUrl: "{{ env('APP_URL') }}",
                    newMessage: '',
                    messages: [],
                    user: {!! json_encode(Auth::user()) !!},
                    userFilter: {!! json_encode(Auth::user()->id) !!},
                    appointment_id: {{ \Request::query('id') }},
                    userId: '3',
                    broadcastMessage: '',
                    notificationSound: new Audio(
                        "{{ asset('assets/notifications/message/message-1.wav') }}"),
                    shouldPalyedSound: false,
                    promise: null,
                };
            },
            methods: {
                async addMessage() {
                    let user_message = {
                        receiver_id: 2,
                        appointment_id: this.appointment_id,
                        text: this.newMessage
                    };

                    if (this.newMessage == '') {
                        return;
                    }

                    try {
                        const response = await axios.post(this.rootUrl + '/chat/send', user_message);
                        this.newMessage = '';
                    } catch (error) {
                        console.error('Error fetching data:', error);
                        // Handle the error as needed
                    } finally {
                        this.$refs.messageInput.focus();

                    }
                },
                async fetchMessages() {
                    try {
                        const response = await axios.get(this.rootUrl + '/chat-get?id=' + this.appointment_id);
                        this.messages = response.data.messages;
                    } catch (error) {
                        console.error('Error fetching data:', error);
                        // Handle the error as needed
                    }
                },
                async currentUser() {
                    return this.userFilter == this.user.id;
                }
            },
            created() {
                this.fetchMessages();
            },
            mounted() {
                // this.$echo.channel('trades').listen('NewTrade', (payload) => {
                //     console.log(payload);
                // });
                // this.promise = notificationSound.play();
                // this.$refs.messageInput.focus();
                // // Initialize Laravel Echo
                // window.Echo = new Echo({
                //     broadcaster: 'pusher',
                //     key: 'a8c1de287d83d8ebd150',
                //     cluster: 'mt1',
                //     forceTLS: false,
                //     wsHost: window.location.hostname,
                //     wsPort: 6001,
                //     disableStats: true,
                // });

                // // Listen for 'NewTrade' event
                // window.Echo.channel('chat').listen('ChatMessage', (e) => {


                //     this.messages.push(e.chat);
                //     if (e.chat.sender_id != {{ auth()->user()->id }}) {
                //         this.shouldPalyedSound = true;
                //         this.notificationSound.play();
                //     }
                // });

            },
            computed: {}
        };

        const createdApp = Vue.createApp(app);
        createdApp.use(DKToast, {
            duration: 10000,
            positionY: 'top', // 'top' or 'bottom'
            positionX: 'right', // 'right' or 'left'
            styles: {
                color: '#000',
                backgroundColor: '#FFDD00',
                // Vendor prefixes also supported
            },
        });

        createdApp.mount('#app');
    </script>
@endsection
