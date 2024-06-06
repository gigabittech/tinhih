@extends('admin.layout.template')

@section('body')

<div class="container">
    <div class="row justify-content-center vh-100">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Checkout') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('printful.processCheckout') }}">
                        @csrf

                        {{-- Shipping Information --}}
                        <div class="form-group">
                            <label for="shipping_address">Shipping Address</label>
                            <textarea id="shipping_address" class="form-control" name="shipping_address" required></textarea>
                        </div>

                        {{-- Payment Information (Example) --}}
                        <div class="form-group">
                            <label for="card_number">Credit Card Number</label>
                            <input id="card_number" type="text" class="form-control" name="card_number" required>
                        </div>
                        <div class="form-group">
                            <label for="expiration_date">Expiration Date</label>
                            <input id="expiration_date" type="text" class="form-control" name="expiration_date" required>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            {{ __('Submit Order') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
