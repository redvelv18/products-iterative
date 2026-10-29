@props(['title' => 'Produkti'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ $title }} — {{ config('app.name', 'Laravel') }}</title>

        {{-- CSS un JS tiek servēti no Vite izstrādes servera --}}
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="holy-grail">
        <header class="holy-grail__header">
            <p class="site-title">
                <a href="{{ route('products.index') }}">Produktu pārvaldība</a>
            </p>
            <nav class="primary-nav" aria-label="Galvenā navigācija">
                <a
                    href="{{ route('products.index') }}"
                    @class(['is-active' => request()->routeIs('products.index', 'products.show')])
                >Produkti</a>
                <a
                    href="{{ route('products.create') }}"
                    @class(['is-active' => request()->routeIs('products.create', 'products.store')])
                >Jauns produkts</a>
            </nav>
        </header>

        <nav class="holy-grail__nav" aria-label="Produktu sadaļas">
            <h2>Sadaļas</h2>
            <ul>
                <li>
                    <a href="{{ route('products.index') }}">Produktu saraksts</a>
                </li>
                <li>
                    <a href="{{ route('products.create') }}">Pievienot produktu</a>
                </li>
            </ul>
        </nav>

        <main class="holy-grail__main" id="main">
            @if (session('status'))
                <p class="flash" role="status">{{ session('status') }}</p>
            @endif

            {{ $slot }}
        </main>

        <aside class="holy-grail__aside">
            <h2>Par sistēmu</h2>
            <p>
                Šī ir produktu CRUD lietotne, kas izmanto maršrutu modeļu sasaisti
                (<code>route model binding</code>) un nosauktos maršrutus.
            </p>
            <p>
                Datu bāze: <strong>SQLite</strong>
            </p>
        </aside>

        <footer class="holy-grail__footer">
            <p>&copy; {{ date('Y') }} Produktu pārvaldība</p>
            {{-- CSS ielādes tests: ja šis teksts ir sarkans, app.css ir ielādēts --}}
            <p class="css-test">CSS test: šim tekstam jābūt sarkanam.</p>
        </footer>
    </body>
</html>
