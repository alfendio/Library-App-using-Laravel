<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\Schema;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Category::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'comic', 'novel', 'fantasy', 'fiction', 'mystery', 'horror', 'romance', 'western'
        ];
        
        foreach ($data as $value) {
            Category::insert([
                'name' => $value
            ]);
        }
    }
}
