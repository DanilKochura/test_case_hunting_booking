<?php

namespace Database\Seeders;

use App\Models\Guide;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GuidesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Создаем конкретных гидов для тестирования
        $specificGuides = [
            [
                'name' => 'Майкл Джексон',
                'experience_years' => 8,
                'is_active' => true,
            ],
            [
                'name' => 'Джон Леннон',
                'experience_years' => 12,
                'is_active' => true,
            ],
            [
                'name' => 'Фредди Меркьюри',
                'experience_years' => 5,
                'is_active' => true,
            ],
            [
                'name' => 'Борис Годунов',
                'experience_years' => 15,
                'is_active' => false,
            ],
            [
                'name' => 'Барак Обама',
                'experience_years' => 5,
                'is_active' => true,
            ],
        ];

        foreach ($specificGuides as $guide) {
            Guide::create($guide);
        }

        $this->command->info('Успешно создано гидов: ' . Guide::count());
    }
}
