<x-layout title="Produkti">
    <div class="page-header">
        <h1>Produkti</h1>
        <a href="{{ route('products.create') }}" class="button button--primary">Pievienot produktu</a>
    </div>

    @if ($products->isEmpty())
        <p class="empty-state">
            Vēl nav neviena produkta. <a href="{{ route('products.create') }}">Pievienojiet pirmo produktu</a>.
        </p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Nosaukums</th>
                    <th scope="col">Cena</th>
                    <th scope="col">Krājums</th>
                    <th scope="col">Darbības</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>
                            <a href="{{ route('products.show', $product) }}">{{ $product->name }}</a>
                        </td>
                        <td>{{ number_format((float) $product->price, 2) }} EUR</td>
                        <td>{{ $product->stock }}</td>
                        <td class="actions">
                            <a href="{{ route('products.show', $product) }}">Skatīt</a>
                            <a href="{{ route('products.edit', $product) }}">Labot</a>
                            <form
                                method="POST"
                                action="{{ route('products.destroy', $product) }}"
                                data-confirm="Vai tiešām dzēst produktu {{ $product->name }}?"
                            >
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="link-button">Dzēst</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</x-layout>
