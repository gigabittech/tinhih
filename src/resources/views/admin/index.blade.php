@extends('admin.layout.template')
@section('body')

@endsection()
@section('extra-script')
    <script>

        function displayMessage(message) {
            $(".response").html("<div class='success'>" + message + "</div>");
            setInterval(function () {
                $(".success").fadeOut();
            }, 1000);
        }
    </script>
@endsection
