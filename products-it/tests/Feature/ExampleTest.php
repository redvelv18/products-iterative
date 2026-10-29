<?php

test('the home page redirects to the product list', function () {
    $response = $this->get('/');

    $response->assertRedirect(route('products.index'));
});
