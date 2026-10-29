@props(['product' => null])

@php
    $isEditing = $product?->exists ?? false;
@endphp

<form
    method="POST"
    action="{{ $isEditing ? route('products.update', $product) : route('products.store') }}"
    class="product-form"
>
    @csrf

    @if ($isEditing)
        @method('PUT')
    @endif

    <div class="field">
        <label for="name">Nosaukums</label>
        <input
            id="name"
            name="name"
            type="text"
            value="{{ old('name', $product?->name) }}"
            required
            maxlength="255"
        >
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="description">Apraksts</label>
        <textarea id="description" name="description" rows="5" maxlength="2000">{{ old('description', $product?->description) }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="price">Cena (EUR)</label>
        <input
            id="price"
            name="price"
            type="number"
            step="0.01"
            min="0"
            value="{{ old('price', $product?->price) }}"
            required
        >
        @error('price')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="field">
        <label for="stock">Krājums</label>
        <input
            id="stock"
            name="stock"
            type="number"
            step="1"
            min="0"
            value="{{ old('stock', $product?->stock ?? 0) }}"
            required
        >
        @error('stock')
            <p class="error">{{ $message }}</p>
        @enderror
    </div>

    <div class="form-actions">
        <button type="submit" class="button button--primary">
            {{ $isEditing ? 'Saglabāt izmaiņas' : 'Izveidot produktu' }}
        </button>

        <a href="{{ $isEditing ? route('products.show', $product) : route('products.index') }}" class="button">
            Atcelt
        </a>
    </div>
</form>
