<section>

    <div class="col-lg-12">
        <div class="card-body mb-5">
            <table class="border-none bg-dark rounded-3" id="table">
                <thead class="text-light">
                    <tr>
                        @stack('table-column-head')
                    </tr>
                </thead>
                <tbody class="text-light border-none">

                    @stack('table-body')

                </tbody>
            </table>
            @if (count($appointments) == null)
                <div class="alert bg-dark text-light">
                    No. Appointments Added Yet. Please Add a Appointment First.
                </div>
            @endif
        </div>
    </div>

</section>
