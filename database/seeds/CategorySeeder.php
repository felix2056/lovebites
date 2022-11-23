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
                'name' => 'sex toys',
                'slug' => 'sex-toys',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'vibrators',
                        'slug' => 'vibrators',
                    ],
                    [
                        'name' => 'penis toys',
                        'slug' => 'penis-toys',
                    ],
                    [
                        'name' => 'anal',
                        'slug' => 'anal',
                    ],
                    [
                        'name' => 'dildos',
                        'slug' => 'dildos',
                    ]
                ]
            ]
        ];

        foreach ($categories as $category) {
            $catid = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => NULL,
                'icon' => NULL,
                'created_at' => now()
            ]);

            foreach($category['subcategory'] as $subcategory) {
                DB::table('sub_categories')->insert([
                    'category_id' => $catid,
                    'name' => $subcategory['name'],
                    'slug' => $subcategory['slug'],
                    'icon' => NULL,
                    'created_at' => now()
                ]);
            }
        }
    }
}
