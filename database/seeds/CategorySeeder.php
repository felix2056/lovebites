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
                'name' => 'Sex Toys',
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
            ],
            [
                'name' => 'Lingerie & Apparel',
                'slug' => 'lingerie-apparel',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'women lingerie & apparel',
                        'slug' => 'women-lingerie-apparel',
                    ],
                    [
                        'name' => 'men lingerie & apparel',
                        'slug' => 'men-lingerie-apparel',
                    ]
                ]
            ],
            [
                'name' => 'Sex Wellness',
                'slug' => 'sex-wellness',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'women wellness',
                        'slug' => 'women-wellness',
                    ],
                    [
                        'name' => 'men wellness',
                        'slug' => 'men-wellness',
                    ]
                ]
            ],
            [
                'name' => 'Bondage & Fetish',
                'slug' => 'bondage-fetish',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'women bdsm',
                        'slug' => 'women-bdsm',
                    ],
                    [
                        'name' => 'men bdsm',
                        'slug' => 'men-bdsm',
                    ]
                ]
            ],
            [
                'name' => 'Pleasure Accessories',
                'slug' => 'pleasure-accessories',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'women accessories',
                        'slug' => 'women-accessories',
                    ],
                    [
                        'name' => 'men accessories',
                        'slug' => 'men-accessories',
                    ]
                ]
            ],
            [
                'name' => 'Seasonal',
                'slug' => 'seasonal',
                'description' => 'If you’re looking to settle for the very best in luxury pleasure, LELO offers the world’s highest quality selection of sex toys for women. Choose from a wide array of sex toys designed to satisfy all your needs, often simultaneously.',
                'subcategory' => [
                    [
                        'name' => 'women seasonal',
                        'slug' => 'women-seasonal',
                    ],
                    [
                        'name' => 'men seasonal',
                        'slug' => 'men-seasonal',
                    ]
                ]
            ]

        ];

        foreach ($categories as $category) {
            $catid = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'icon' => NULL,
                'created_at' => now()
            ]);

            if(isset($category['subcategory'])) {
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
}
