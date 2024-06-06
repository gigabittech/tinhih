<div id="successAlert" class="alert alert-success" role="alert">
    {{ Session::get('success') }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get the success alert element
        var successAlert = document.getElementById('successAlert');

        // Set a timeout to hide the alert after 5000 milliseconds (5 seconds)
        setTimeout(function () {
            successAlert.style.display = 'none';
        }, 2000);
    });
</script>
