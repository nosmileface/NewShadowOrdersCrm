<?php

namespace Database\Seeders\ClientCategory\Status\Category;

use App\Models\ClientCategory\Client\Status\Category\ClientStatusCategory;
use Illuminate\Database\Seeder;

class ClientStatusCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientStatusCategories = [
            [
                'category_id' => 1,
                'name' => 'Обращения',
                'type' => 'interact',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Приехал',
                'type' => 'priexal',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Заявки',
                'type' => 'correct',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Квал',
                'type' => 'qualified',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Визит',
                'type' => 'visit',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Доход',
                'type' => 'credit',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Добро',
                'type' => 'approved',
                'is_active' => true
            ],
            [
                'category_id' => 1,
                'name' => 'Некор',
                'type' => 'incorrect',
                'is_active' => true
            ]
        ];

        foreach ($clientStatusCategories as $clientStatusCategory) {
            ClientStatusCategory::query()->updateOrCreate(
                ['category_id' => $clientStatusCategory['category_id'], 'type' => $clientStatusCategory['type']],
                ['name' => $clientStatusCategory['name'], 'is_active' => $clientStatusCategory['is_active']]
            );
        }
    }
}
