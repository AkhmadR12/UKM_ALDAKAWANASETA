<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.layout.css')
 

</head>

<body>

   

    <!-- Navbar & Hero End -->

    <!-- Modal Search Start -->
    @include('frontend.layout.header')
    <!-- Modal Search End -->
    <main class="main">

        <h1>{{ $product->name }}</h1>
        <img src="{{ asset('storage/'.$product->image) }}" width="300">
        <p>{{ $product->description }}</p>
        <p><strong>Rp{{ number_format($product->price) }}</strong></p>

        @auth
            <form action="{{ route('checkout.store') }}" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit">Checkout Sekarang</button>
            </form>
        @else
            <a href="{{ route('login') }}">Login untuk Checkout</a>
        @endauth
</main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>

</html>