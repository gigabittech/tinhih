@extends('admin.layout.template')

@section('body')

    <div class="container-fluid bg-black pt-4 vh-100">
        <div class="row">
            <div class="col-sm-6 col-lg-3">
                <div class="card mb-4 text-white bg-dark p-3">
                    cart
                    
                    
                    @foreach ($carts['result']["sync_variants"] as $cart)
                        <div class="cart-item">
                            <h4>{{ $cart['name'] }}</h4>
                            <p>Quantity: {{ $cart['files'][1]['thumbnail_url'] }}</p>
                            <p>Currency: {{ $cart['currency'] }}</p>
                        {{-- </div>--}}
                    @endforeach
                    
                    <a href="{{ route('printful.checkout') }}">Checkout</a>
                    <iframe width="560" height="315" src="https://www.youtube.com/embed/dQw4w9WgXcQ" frameborder="0" allowfullscreen></iframe>



                </div>
            </div>
            
            
        
        </div>
    </div>



@endsection
