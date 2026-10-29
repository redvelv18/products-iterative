<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $this->withoutVite();
});

it('displays the product list', function () {
    $products = Product::factory(3)->create();

    $this->get(route('products.index'))
        ->assertOk()
        ->assertViewIs('products.index')
        ->assertViewHas('products', fn ($viewProducts) => $viewProducts->count() === 3)
        ->assertSee($products->first()->name);
});

it('displays the create form', function () {
    $this->get(route('products.create'))
        ->assertOk()
        ->assertViewIs('products.create');
});

it('stores a new product', function () {
    $payload = [
        'name' => 'Testa produkts',
        'description' => 'Produkta apraksts',
        'price' => '19.99',
        'stock' => 5,
    ];

    $response = $this->post(route('products.store'), $payload);

    $product = Product::firstWhere('name', 'Testa produkts');

    expect($product)->not->toBeNull()
        ->and($product->price)->toBe('19.99')
        ->and($product->stock)->toBe(5);

    $response->assertRedirect(route('products.show', $product))
        ->assertSessionHas('status');
});

it('validates the product data', function () {
    $this->post(route('products.store'), [
        'name' => '',
        'description' => null,
        'price' => 'nav skaitlis',
        'stock' => -1,
    ])->assertSessionHasErrors(['name', 'price', 'stock']);

    expect(Product::count())->toBe(0);
});

it('displays a single product using route model binding', function () {
    $product = Product::factory()->create();

    $this->get(route('products.show', $product))
        ->assertOk()
        ->assertViewIs('products.show')
        ->assertViewHas('product', fn ($viewProduct) => $viewProduct->is($product))
        ->assertSee($product->name);
});

it('returns not found for a missing product', function () {
    $this->get(route('products.show', 999))->assertNotFound();
});

it('displays the edit form', function () {
    $product = Product::factory()->create();

    $this->get(route('products.edit', $product))
        ->assertOk()
        ->assertViewIs('products.edit')
        ->assertViewHas('product', fn ($viewProduct) => $viewProduct->is($product));
});

it('updates an existing product', function () {
    $product = Product::factory()->create();

    $this->put(route('products.update', $product), [
        'name' => 'Atjaunināts produkts',
        'description' => 'Jauns apraksts',
        'price' => '42.50',
        'stock' => 12,
    ])->assertRedirect(route('products.show', $product));

    expect($product->refresh())
        ->name->toBe('Atjaunināts produkts')
        ->price->toBe('42.50')
        ->stock->toBe(12);
});

it('deletes a product', function () {
    $product = Product::factory()->create();

    $this->delete(route('products.destroy', $product))
        ->assertRedirect(route('products.index'));

    $this->assertModelMissing($product);
});
