<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if($this->command->confirm('Do you want to refresh the categories table?')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            DB::table('categories')->truncate();
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->command->info('Categories table truncated.');
        } else {
            $this->command->info('Categories table not truncated.');
        }

        $categories = [
            [
                'name' => 'Sex Toys for Women',
                'slug' => 'sex-toys-for-women',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.'
            ]
        ];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'created_at' => now()
            ]);
        }
    }
}
