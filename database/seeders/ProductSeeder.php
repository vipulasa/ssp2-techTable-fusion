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
                'price' => 5.99
            ],
            [
                'name' => 'Stuffed Mushrooms',
                'category' => 'Appetizers',
                'description' => 'Savory mushrooms stuffed with a blend of cream cheese, herbs, and breadcrumbs, baked until golden.',
                'price' => 7.49
            ],
            [
                'name' => 'Spaghetti Carbonara',
                'category' => 'Main Courses',
                'description' => 'Classic Italian pasta with pancetta, eggs, and Parmesan cheese, served in a creamy sauce.',
                'price' => 12.99
            ],
            [
                'name' => 'Margherita Pizza',
                'category' => 'Main Courses',
                'description' => 'Thin-crust pizza topped with fresh mozzarella, tomatoes, and basil, baked in a wood-fired oven.',
                'price' => 10.99
            ],
            [
                'name' => 'Tiramisu',
                'category' => 'Desserts',
                'description' => 'A traditional Italian dessert made with layers of espresso-soaked ladyfingers and mascarpone cheese.',
                'price' => 6.49
            ],
            [
                'name' => 'Cheesecake',
                'category' => 'Desserts',
                'description' => 'Rich and creamy cheesecake with a graham cracker crust, served with your choice of topping.',
                'price' => 5.99
            ],
            [
                'name' => 'Coca Cola',
                'category' => 'Beverages',
                'description' => 'Chilled classic cola with a refreshing taste.',
                'price' => 1.99
            ],
            [
                'name' => 'Lemonade',
                'category' => 'Beverages',
                'description' => 'Freshly squeezed lemonade, served over ice.',
                'price' => 2.49
            ],
            [
                'name' => 'Caesar Salad',
                'category' => 'Salads',
                'description' => 'Crisp romaine lettuce with croutons, Parmesan cheese, and Caesar dressing.',
                'price' => 7.99
            ],
            [
                'name' => 'Greek Salad',
                'category' => 'Salads',
                'description' => 'Mixed greens with tomatoes, cucumbers, olives, and feta cheese, dressed with olive oil and vinegar.',
                'price' => 8.49
            ]
        ];

        foreach ($products as $product) {
            $category = \App\Models\Category::where('name', $product['category'])->first();

            \App\Models\Product::create([
                'name' => $product['name'],
                'description' => $product['description'],
                'price' => $product['price'],
                'category_id' => $category->id,
                'sort_order' => 0,
                'status' => true
            ]);
        }
    }
}
