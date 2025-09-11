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
        <h1>Katalog Produk</h1>
        <div style="display: flex; flex-wrap: wrap; gap: 20px;">
        @foreach ($products as $product)
            <div style="border: 1px solid #ccc; padding: 10px; width: 200px;">
                <img src="{{ asset('storage/'.$product->image) }}" width="100%">
                <h3>{{ $product->name }}</h3>
                <p>Rp{{ number_format($product->price) }}</p>
                <a href="{{ route('product.detail', $product) }}">Beli Sekarang</a>
            </div>
        @endforeach
        </div>
    </main>     

    <!-- Footer Start -->
    @include('frontend.layout.footer')
    @include('frontend.layout.js')
</body>

</html>
