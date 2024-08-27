<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $products = [
            [
                'name' => 'Bruschetta',
                'category' => 'Appetizers',
                'description' => 'Crispy bread topped with a mix of fresh tomatoes, basil, and garlic, drizzled with olive oil.',
                'price' => 5.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRNuBhefAu00Ith0_LNUq9Tv8r0iPgyr7hIvw&s'
            ],
            [
                'name' => 'Stuffed Mushrooms',
                'category' => 'Appetizers',
                'description' => 'Savory mushrooms stuffed with a blend of cream cheese, herbs, and breadcrumbs, baked until golden.',
                'price' => 7.49,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSRGfKnBrZ_1LPR-jjUFtOaj5xGQJXT-d0BTg&s'
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'category' => 'Main Courses',
                'description' => 'Classic Italian pasta with pancetta, eggs, and Parmesan cheese, served in a creamy sauce.',
                'price' => 12.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRMxFe1YyWzN78yVVq6Q8rvJ7P6FuZXKb3X4g&s'
            ],
            [
                'name' => 'Margherita Pizza',
                'category' => 'Main Courses',
                'description' => 'Thin-crust pizza topped with fresh mozzarella, tomatoes, and basil, baked in a wood-fired oven.',
                'price' => 10.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSb_y0UJ8gUAGadziRuqwO4MWWBkxbOPNTssQ&s'
            ],
            [
                'name' => 'Tiramisu',
                'category' => 'Desserts',
                'description' => 'A traditional Italian dessert made with layers of espresso-soaked ladyfingers and mascarpone cheese.',
                'price' => 6.49,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNYRFy45e_gkAiGsTNao6dmUmxSJBQ3rjWrQ&s'
            ],
            [
                'name' => 'Cheesecake',
                'category' => 'Desserts',
                'description' => 'Rich and creamy cheesecake with a graham cracker crust, served with your choice of topping.',
                'price' => 5.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTxDIBKWRQWja9b128TVshvbVDNiaN__ZvyDQ&s'
            ],
            [
                'name' => 'Coca Cola',
                'category' => 'Beverages',
                'description' => 'Chilled classic cola with a refreshing taste.',
                'price' => 1.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQx44wPqkU9DF7HpVFuDrVzrr6RDTylqPLJVw&s'
            ],
            [
                'name' => 'Lemonade',
                'category' => 'Beverages',
                'description' => 'Freshly squeezed lemonade, served over ice.',
                'price' => 2.49,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSzixmJm1j6aLFZpncyOjQHSS3vI1BSrFLaow&s'
            ],
            [
                'name' => 'Caesar Salad',
                'category' => 'Salads',
                'description' => 'Crisp romaine lettuce with croutons, Parmesan cheese, and Caesar dressing.',
                'price' => 7.99,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOIiNbCtvRjdGunEXvzblckJtNTZRe4eYDvw&s'
            ],
            [
                'name' => 'Greek Salad',
                'category' => 'Salads',
                'description' => 'Mixed greens with tomatoes, cucumbers, olives, and feta cheese, dressed with olive oil and vinegar.',
                'price' => 8.49,
                'image' => 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcReM4TuoNDVRY9II2SMERI0SgvLQXeGKWm81A&s'
            ]
        ];

        foreach ($products as $product) {
            $category = \App\Models\Category::where('name', $product['category'])->first();

            $product_object = \App\Models\Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'category_id' => $category->id,
                'sort_order' => 0,
                'status' => true
            ]);

            $product_object->addMediaFromUrl($product['image'])->toMediaCollection('featured');
        }
    }
}
