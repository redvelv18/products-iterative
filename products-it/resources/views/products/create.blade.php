<x-layout title="Jauns produkts">
    <div class="page-header">
        <h1>Jauns produkts</h1>
        <a href="{{ route('products.index') }}" class="button">Atpakaļ uz sarakstu</a>
    </div>

    <x-product-form />
</x-layout>
