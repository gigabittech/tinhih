    @extends('admin.layout.template')

    @section('body')
        <!-- Table Area Start -->
        <div class="container-fluid bg-black p-5" id="appointment">
            <div class="row">
                <div class="col-lg-12 vh-100">
                    @if (Session::has('success'))
                        @include('admin.includes.message.success')
                    @elseif(Session::has('error'))
                        @include('admin.includes.message.error')
                    @endif

                    <h4 class="text-white mb-4"><strong>Create Appointment</strong></h4>

                    <div class="col-sm-6 col-lg-12 profile-field">
                        <div class="card-body bg-dark bg-dark1 p-5">
                            <form @submit.prevent="saveAppointment" enctype="multipart/form-data">
                                @csrf
                                <!-- Add this code after each input field -->
                                <div class="form-group">
                                    <p class="text-white mt-3">Select Provider Specialization</p>
                                    <select v-model="specializationId" @change="handleChange('specialization')"
                                        class="form-control">
                                        <option value="" disabled selected>Select Provider Specification</option>
                                        <option v-for="item in specializations" :value="item.id"
                                            :key="item.id">
                                            @{{ item.title }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="text-white mt-3">Please Select Provider</p>
                                    <select v-model="providerId" @change="handleChange('provider')" class="form-control">
                                        <option value="" disabled selected>Select a provider</option>
                                        <option v-for="provider in providers" :value="provider.id" :key="provider.id">
                                            @{{ provider.first_name }} @{{ provider.last_name }}
                                        </option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <p class="text-white mt-3">Please Select Available Slot</p>
                                    <select v-model="scheduleId" @change="handleChange('schedule')" class="form-control">
                                        <option value="" disabled selected>Select a schedule slot</option>
                                        <option v-for="schedule in schedules" :value="schedule.id" :key="schedule.id">
                                            @{{ schedule.start_time }} - @{{ schedule.end_time }}
                                        </option>
                                    </select>
                                </div>
                                {{-- <div class="form-group">
                                    <p class="text-white mt-3">Please Select Client</p>
                                    <select v-model="clientId" @change="handleChange('client')" class="form-control">
                                        <option value="" disabled selected>Select Client</option>
                                        <option v-for="item in clients" :value="item.client.id" :key="item.id">
                                            <span v-if="item.client!=null">
                                                @{{ item.client.first_name }} @{{ item.client.last_name }}
                                            </span>
                                        </option>
                                    </select>
                                </div> --}}
                                <div class="form-group">
                                    <p class="text-white mt-3">Booking Date</p>
                                    <input type="text" id="datepicker" v-model="booking_time" name="booking_time"
                                        class="form-control" autocomplete="off" value="today">
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary login-button w-100" type="submit">Create
                                        Appointment
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Form Area Ends -->
    @endsection
    @section('extra-script')
        <script>
            const app = {
                // components: {
                //     VueTagsInput,
                // },
                // components: { Multiselect },
                data() {
                    return {
                        specializations: [],
                        specializationId: 0,
                        providers: [],
                        providerId: 0,
                        clients: [],
                        clientId: {{ Auth::user()->client->id }},
                        schedules: [],
                        scheduleId: 0,
                        // client_by_user_id: '',
                        booking_time: '',

                        isAppointmentExist: false
                    }

                },
                methods: {


                    getSpecifications() {
                        const url = '{{ route('specializations.get') }}';

                        this.get(url).then(data => {

                                this.specializations = data
                                    .specializations; // Update the component's data with the fetched data

                            })
                            .catch(error => {
                                // Handle the error if needed
                            });
                    },
                    getProviders(specializationId) {
                        const url = '{{ route('providers.getBySPId') }}?providerId=' + specializationId;

                        this.get(url).then(data => {
                                this.providers = data.providers; // Update the component's data with the fetched data
                            })
                            .catch(error => {
                                // Handle the error if needed
                            });
                    },
                    getClients() {
                        const url = '{{ route('clients.get') }}';


                        this.get(url).then(data => {
                                this.clients = data.clients.filter(item => item.client !==
                                    null); // Update the component's data with the fetched data

                            })
                            .catch(error => {
                                // Handle the error if needed
                            });
                    },
                    getSchedulesOfProviders(providerId) {
                        const url = '{{ route('schedules.get') }}?provider_id=' + providerId;
                        this.get(url).then(data => {
                                this.schedules = data.schedules; // Update the component's data with the fetched data
                            })
                            .catch(error => {
                                // Handle the error if needed
                            });
                    },
                    handleChange(parameter) {
                        if (parameter === 'specialization') {
                            this.getProviders(this.specializationId);
                        }
                        if (parameter === 'provider') {
                            const selectedProvider = this.providers.find(provider => provider.id === this.providerId);

                            // Update client_by_user_id based on the selected provider
                            this.client_by_user_id = selectedProvider.user_id;

                            this.getSchedulesOfProviders(this.providerId);
                        }
                        if (parameter === 'schedule') {}
                    },


                    async saveAppointment() {

                        const appointmentObject = {
                            'provider_id': this.providerId,
                            'client_id': this.clientId,
                            'schedule_id': this.scheduleId,
                            'booking_time': this.booking_time,
                            // 'client_by_user_id': this.client_by_user_id,
                        }

                        let isValidationPassed = await this.checkAppointment();

                        if (isValidationPassed) {
                            const url = '{{ route('appointment.save') }}'
                            this.post(url, appointmentObject).then(data => {
                                    if (data.status == "ok") {
                                        this.$toast('Appointment Created Succesfully ');
                                        notify();
                                        this.specializationId = 0;
                                        this.providerId = 0;
                                        this.clientId = 0;
                                        this.scheduleId = 0;
                                        this.booking_time = '';
                                        this.client_by_user_id = 0
                                    } else if (data.status == "date-error") {
                                        this.$toast('The Appointment date must be a date after or equal to today');
                                    } else if (data.status == "slot-error") {
                                        this.$toast(data.message);
                                    }
                                })
                                .catch(error => {
                                    // Handle the error if needed
                                });
                        }


                    },
                    isFrontendvalidationPassed(data) {
                        let isValidationPassed = false;

                        if (this.providerId != 0 & this.clientId != 0 & this.scheduleId != "" & this.booking_time != "") {
                            isValidationPassed = true;
                        } else {
                            this.$toast('please fill out the required field');
                        }
                        return isValidationPassed

                    },
                    async checkAppointment() {

                        let isValidationPassed = false;

                        if (this.isFrontendvalidationPassed()) {

                            const url = '{{ route('appointment.check') }}' +
                                "?provider_id=" + this.providerId +
                                "&client_id=" + this.clientId +
                                "&schedule_id=" + this.scheduleId +
                                "&booking_time=" + this.booking_time


                            await this.get(url).then(data => {
                                    if (data.appointment == 'exist') {
                                        isValidationPassed = false;
                                        this.$toast('Appointment already exist');
                                    } else {
                                        isValidationPassed = true;
                                    }
                                })
                                .catch(error => {
                                    // Handle the error if needed
                                });

                        }

                        return isValidationPassed
                    },


                    /* axios methods  */
                    async get(url) {

                        return axios.get(url)
                            .then(response => response.data)
                            .catch(error => {
                                console.error('Error fetching data:', error);
                                throw error; // Rethrow the error to handle it at the component level if needed
                            });

                    },
                    async post(url, dataSet) {

                        return await axios.post(url, dataSet).then(response => response.data)
                            .catch(error => {
                                console.error('Error fetching data:', error);
                                throw error; // Rethrow the error to handle it at the component level if needed
                            });

                    },


                    onFileChange(e) {
                        const file = e.target.files[0];
                        this.seriesImageFile = file;
                        this.seriesImage = URL.createObjectURL(file);
                    },


                },
                created: function() {
                    this.getSpecifications();
                    this.getClients();
                },

                mounted: function() {

                },
                computed: {},

            };

            const createdApp = Vue.createApp(app);
            createdApp.use(DKToast, {
                duration: 5000, // 5 seconds


                styles: {
                    color: '#000',
                    backgroundColor: '#FFDD00',
                    marginTop: '80px',
                },
                positionY: 'top',
            });


            createdApp.mount('#appointment')


            document.addEventListener('DOMContentLoaded', function() {
                flatpickr("#datepicker", {
                    dateFormat: "Y-m-d",
                    // You can customize further options here
                });
            });
        </script>
    @endsection
