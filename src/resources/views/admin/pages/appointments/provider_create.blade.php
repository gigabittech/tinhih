@extends('admin.layout.template')

@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid bg-black p-5" id="appointment">
        <div class="row">
            <div class="col-lg-12 vh-100">
                <form @submit.prevent="saveAppointment" enctype="multipart/form-data">
                    @csrf
                    <div class="col-lg-12 bg-dark1 p-5 mb-5 profile-field">
                        <h4 class="text-white mb-5 text-center">Create a New Appointment</h4>

                        <p class="text-white mt-3">Please select a provider available time slot</p>
                        <select v-model="scheduleId" @click="getSchedulesOfProviders('{{ auth()->user()->provider->id }}')"
                            class="form-control">
                            <option value="" disabled>Select schedule</option>
                            <option v-for="schedule in schedules" :value="schedule.id" :key="schedule.id">
                                @{{ schedule.start_time }} @{{ schedule.end_time }}
                            </option>
                        </select>

                        <p class="text-white mt-3">Please Select a client</p>
                        <select v-model="clientId" @click="getAllClients()" class="form-control">
                            <option value="" disabled>Select client</option>
                            <option v-for="client in clients" :value="client.id" :key="client.id">
                                @{{ client.first_name }} @{{ client.last_name }}
                            </option>
                        </select>

                        <p class="text-white mt-3">Booking Date</p>
                        <div class="form-group">
                            <div class="form-group">
                                @error('booking_time')
                                    <span class="text-primary fw-semibold mb-5">{{ $message }}</span>
                                @enderror
                                <input type="text" id="datepicker" v-model="booking_time" name="booking_time"
                                    class="form-control flatpicker-input" autocomplete="off">
                            </div>
                        </div>
                        @error('booking_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror


                        <div class="form-group">
                            <button class="btn btn-primary login-button w-100" type="submit">Create
                                Appointment</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Form Area Ends -->
@endsection
@section('extra-script')
    <script>
        const app = {
            data() {
                return {
                    providers: [],
                    providerId: '{{ Auth::user()->provider->id }}',
                    clients: [],
                    clientId: 0,
                    schedules: [],
                    scheduleId: 0,
                    client_by_user_id: '{{ auth()->user()->id }}',
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

                getAllClients() {
                    const url = '{{ route('clients.all') }}';
                    this.get(url).then(data => {
                            // console.log(data.clients)
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
                    if (parameter === 'schedule') {
                        this.getProviderSchedule();
                    }
                },


                async saveAppointment() {
                    const appointmentObject = {
                        'provider_id': this.providerId,
                        'client_id': this.clientId,
                        'schedule_id': this.scheduleId,
                        'booking_time': this.booking_time,
                        'client_by_user_id': this.client_by_user_id,
                    }

                    let isValidationPassed = await this.checkAppointment();

                    if (isValidationPassed) {
                        const url = '{{ route('appointment.save') }}'
                        this.post(url, appointmentObject).then(data => {
                                if (data.status == "ok") {
                                    this.$toast('Appointment Created Succesfully ');
                                    // this.providerId = 0;
                                    // this.client_by_user_id = ''
                                    this.clientId = 0;
                                    this.scheduleId = 0;
                                    this.booking_time = '';
                                    notify();
                                } else if (data.status == "date-error") {
                                    this.$toast('The Appointment date must be after or equal to today');
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
                                } else if (data.appointment == 'date-error') {
                                    isValidationPassed = false;
                                    this.$toast('The Appointment time must be a date after or equal to today');
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
                marginTop: '80px'
            },
            positionY: 'top', // Corrected property name
        });


        createdApp.mount('#appointment')
    </script>
    <!-- Include jQuery library (if not already included) -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <!-- JavaScript to update client_by_user_id based on the selected client -->
    <script>
        $(document).ready(function() {
            $('#clientSelect').change(function() {
                // Get the selected option
                var selectedOption = $(this).find(':selected');

                // Get the user ID from the data attribute
                var userId = selectedOption.data('user-id');

                // Update the client_by_user_id input field
                $('#client_by_user_id').val(userId);
            });
        });


        document.addEventListener('DOMContentLoaded', function() {
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d",
                // You can customize further options here
            });
        });
    </script>
@endsection
