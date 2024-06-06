<!DOCTYPE html>

<html lang="en">

<head>

    @include('admin.includes.info')
    @include('admin.includes.css')
    @yield('extra-style')
</head>

<body>


    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MNSBL48B" height="0" width="0"
            style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->


    @include('admin.includes.sidebar')

    <div class="wrapper d-flex flex-column min-vh-100 bg-light">
        @include('admin.includes.header')



        @yield('body')



        @include('admin.includes.footer')
        @include('admin.includes.scripts')
        <script>
            function notify() {
                var notificationNumber = document.getElementById("notification-no").innerText;
                document.getElementById("notification").play();
                notificationNumber++;
                document.getElementById("notification-no").innerText = notificationNumber;
                document.getElementById("bell").classList.add("text-primary");
            }
        </script>

        @include('admin.includes.deleteSelected')
        @yield('extra-script')
    </div>

</body>

</html>
