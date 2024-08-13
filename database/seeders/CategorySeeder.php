<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {

        $categories = [
            'Appetizers' => [
                'Bruschetta',
                'Stuffed Mushrooms',
                'Garlic Bread',
                'Chicken Wings'
            ],
            'Main Courses' => [
                'Spaghetti Carbonara',
                'Margherita Pizza',
                'Grilled Salmon',
                'Beef Stroganoff'
            ],
            'Desserts' => [
                'Tiramisu',
                'Cheesecake',
                'Chocolate Lava Cake',
                'Gelato'
            ],
            'Beverages' => [
                'Coca Cola',
                'Lemonade',
                'Espresso',
                'Red Wine'
            ],
            'Salads' => [
                'Caesar Salad',
                'Greek Salad',
                'Caprese Salad',
                'Garden Salad'
            ]
        ];

        foreach ($categories as $category => $items) {
            $category = \App\Models\Category::create([
                'name' => $category,
                'description' => 'Category description',
                'sort_order' => 0,
                'status' => true
            ]);

            foreach ($items as $item) {
                \App\Models\Category::create([
                    'name' => $item,
                    'description' => 'Item description',
                    'sort_order' => 0,
                    'status' => true,
                    'parent_id' => $category->id
                ]);
            }
        }


    }
}
