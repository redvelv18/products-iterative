<x-layout :title="$product->name">
    <div class="page-header">
        <h1>{{ $product->name }}</h1>
        <div class="actions">
            <a href="{{ route('products.edit', $product) }}" class="button button--primary">Labot</a>
            <a href="{{ route('products.index') }}" class="button">Atpakaļ uz sarakstu</a>
        </div>
    </div>

    <dl class="details">
        <dt>Nosaukums</dt>
        <dd>{{ $product->name }}</dd>

        <dt>Cena</dt>
        <dd>{{ number_format((float) $product->price, 2) }} EUR</dd>

        <dt>Krājums</dt>
        <dd>{{ $product->stock }} gab.</dd>

        <dt>Apraksts</dt>
        <dd>{{ $product->description ?: 'Apraksts nav norādīts.' }}</dd>

        <dt>Izveidots</dt>
        <dd>{{ $product->created_at->format('d.m.Y H:i') }}</dd>

        <dt>Atjaunināts</dt>
        <dd>{{ $product->updated_at->format('d.m.Y H:i') }}</dd>
    </dl>

    <form
        method="POST"
        action="{{ route('products.destroy', $product) }}"
        data-confirm="Vai tiešām dzēst produktu {{ $product->name }}?"
    >
        @csrf
        @method('DELETE')
        <button type="submit" class="button button--danger">Dzēst produktu</button>
    </form>
</x-layout>
