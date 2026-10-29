<x-layout title="Labot produktu">
    <div class="page-header">
        <h1>Labot produktu</h1>
        <a href="{{ route('products.show', $product) }}" class="button">Atpakaļ uz produktu</a>
    </div>

    <x-product-form :product="$product" />
</x-layout>
