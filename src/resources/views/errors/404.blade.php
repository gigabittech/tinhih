@extends('admin.layout.template')

@section('body')
    <!-- Table Area Start -->
    <div class="container-fluid h-100vh bg-black p-5" id="appointment">
        <div class="row">
            <div class="col-lg-12 text-center">
                <h2 class="text-primary" style="font-size: 75px">404</h2>
                <h4 class="text-white pb-3" style="font-size: 25px">OPPS!PAGE NOT FOUND</h4>
                <a href="{{ route('dashboard.index') }}" class="btn btn-primary">Back to Home</a>
            </div>

        </div>
    </div>
    <!-- Form Area Ends -->
@endsection
    