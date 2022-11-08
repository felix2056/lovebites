<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // delete images
        $storagePath = storage_path('app/public') .'/products';
        system("rm -rf ". escapeshellarg($storagePath));

        // copy directory from public to storage
        system("cp -r ".escapeshellarg(public_path('/images/products'))." ".escapeshellarg($storagePath));
        // $this->copyDirectory(public_path('images/products'), storage_path('app/public/products'));

        if($this->command->confirm('Do you want to refresh the products table?')) {
            DB::statement('SET FOREIGN_KEY_CHECKS=0;');
            
            DB::table('product_ratings')->truncate();
            DB::table('products')->truncate();
            
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
            $this->command->info('Products table truncated.');
        } else {
            $this->command->info('Products table not truncated.');
        }

        for ($i = 1; $i <= 21; $i++) {
            $images = [
                'product-' . $i . '_1.jpg',
                'product-' . $i . '_2.jpg',
                'product-' . $i . '_3.jpg',
                'product-' . $i . '_4.jpg',
                'product-' . $i . '_5.jpg',
                'product-' . $i . '_6.jpg',
                'product-' . $i . '_7.jpg',
                'product-' . $i . '_8.jpg'
            ];

            DB::table('products')->insert([
                'name' => 'Product ' . $i,
                'slug' => 'product-' . $i,
                'details' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p> <ul><li>Any Product types that You want - Simple, Configurable</li><li>Downloadable/Digital Products, Virtual Products</li><li>Inventory Management with Backordered items</li></ul><p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
                'price' => number_format((mt_rand(1099, 9999) / 100), 2, '.', ''),
                'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
                'featured_image' => 'product-' . $i . '.jpg',
                'images' => json_encode($images),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    public function copyDirectory($source, $destination)
    {
        $dir = opendir($source);
        
        if (!file_exists($destination)) mkdir($destination);

        while (false !== ($file = readdir($dir))) {
            if (($file != '.') && ($file != '..')) {
                if (is_dir($source . '/' . $file)) {
                    $this->copyDirectory($source . '/' . $file, $destination . '/' . $file);
                    continue;
                } else {
                    copy($source . '/' . $file, $destination . '/' . $file);
                }
            }
        }
        closedir($dir);
    }
}
