<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ItemServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $items = [
            [
                'id' => 1,
                'name' => 'LEONARD COAT',
                'description' => "Minimalistic coat in cotton-blend.",
                'price' => 399.00,
                'image_url' => '/images/leonard-coat.jpg',
            ],
            [
                'id' => 2,
                'name' => 'Modern Jacket',
                'description' => "Modern jacket for men, stylish and warm.",
                'price' => 250.00,
                'image_url' => '/images/leonard-coat-2.jpg',
            ],
            [
                'id' => 3,
                'name' => 'Classic Trench Coat',
                'description' => "Timeless trench coat with water-resistant material.",
                'price' => 450.00,
                'image_url' => '/images/lether-jacket.jpg',
            ]
            ,
            [
                'id' => 4,
                'name' => 'Casual Hoodie',
                'description' => "Comfortable cotton hoodie for everyday use.",
                'price' => 120.00,
                'image_url' => '/images/modern-jacket.jpg',
            ]
        ];

        // Compartilhar os itens com todas as views
        View::share('items', $items);
    }

    public function register()
    {
        //
    }
}