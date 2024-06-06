@extends('admin.layout.template')


@section('extra-style')
@endsection

@section('body')
    <div id="app" class="vh-100">
        @{{ message }}
        {{-- Trade: -<span id="message"></span> --}}
    </div>
@endsection


@section('extra-script')
    {{-- <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script type="module">
        import Echo from '/gigabit/tinhih/src/node_modules/laravel-echo/dist/echo.js';

        window.Echo = new Echo({
            broadcaster: 'pusher',
            key: "a8c1de287d83d8ebd150",
            cluster: 'mt1',
            forceTLS: false,
            wsHost: window.location.hostname,
            wsPort: 6001,
            disableStats: true,
        });

        window.Echo.channel('trades').listen('NewTrade', (e) => {
            console.log(e);
            document.getElementById('message').textContent = e.trade;
        });
    </script> --}}

    <!-- Your main JavaScript file -->

    <script src="https://cdn.jsdelivr.net/npm/vue-echo-laravel@1.0.0/dist/build.min.js"></script>

    <!-- Your main JavaScript file -->
    <script src="{{ mix('js/app.js') }}"></script>
    <script src="{{ asset('admin/js/vue-component.js') }}"></script>
@endsection
