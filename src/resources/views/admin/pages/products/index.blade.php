@extends('admin.layout.template')

@section('body')

    <div class="container-fluid bg-black pt-4 vh-100">
        <div class="row">
            
        <div class="col-lg-12 text-center mb-5">
            <h1 class="text-white">Products</h1>
        </div>

        @foreach ($products['result'] as $product)
            <div class="col-sm-6 col-lg-3 rounded">
                <img src="{{ $product['thumbnail_url'] }}" alt="{{ $product['name'] }}" class="w-100">
                <div class="card mb-4 text-white bg-dark p-3">
                    <h4>{{ $product['name'] }}</h4>
                    <h4>{{ $product['variants'] }}</h4>
                    <form action="{{route('add')}}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product['id'] }}">
                        <button type="submit" class="login-button w-100">Add to Cart</button>
                    </form>
                </div>
            </div>
            
        @endforeach
            
            
        
        </div>
    </div>



@endsection
