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

        $category = DB::table('categories as c')
            ->select('c.id')
            ->where('c.slug', 'sex-toys-for-women')
            ->first();

        $products = [];
        $products[] = [
            'category_id' => $category->id,
            'name' => 'LELO DOT™',
            'slug' => 'lelo-dot',
            'description' => 'LELO DOT™ is a clitoral pinpoint vibrator used externally that allows for multiple orgasms. Traditional vibrators may numb the area around the clitoris and, more often than not, prevent you from experiencing multiple orgasms. But, thanks to its soft and bendable tip and revolutionary elliptical motion, LELO DOT™ offers climaxing with unmatched precision. It is perfect for exhilarating solo or unintrusive coupled play, allowing a versatile approach to self-pleasure.',
            'price' => 179.99,
            'details' => 'Unleash your orgasmic potential with LELO Smart Bead™ - a vibrating egg that responds to your every squeeze. Set up an easy-to-follow workout routine and let the vibration patterns guide you to more prolonged and stronger orgasms. Using the feedback from its touch sensors, LELO Smart Bead™ automatically selects and updates the training routine according to your performance.',
            
            'meta' => json_encode([
                [
                    'title' => 'Materials',
                    'description'=>	'Body-safe silicone / ABS plastic'
                ],
                [
                    'title' => 'Finish',
                    'description'=> 'Matte',
                ],
                [
                    'title' => 'Size',	
                    'description' => '31 x 34 x 82 mm / 1.2 x 1.3 x 3.2 in'
                ],
                [
                    'title' => 'Weight',
                    'description' => '50 g / 1.8 oz'
                ],
                [
                    'title' => 'Battery',
                    'description' => '	1 x AAA battery'
                ],
                [
                    'title' => 'Standby',
                    'description' => '30 days'
                ],
                [
                    'title' => 'Frequency',
                    'description' => '200 Hz'
                ],
                [
                    'title' => 'Max. noise level',
                    'description' => '50 dB'
                ],
                [
                    'title' => 'Interface',
                    'description' => '1 button'
                ]
            ]),

            'features' => json_encode([
                [
                    'title' => 'FOR YEARS TO COME',
                    'description' => 'made for long term satisfaction',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_FOR_YEARS_TO_COME_80x80px.svg?VersionId=5yD4lwakyllbudh6faB1y2GLGmfMlnzL" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_FOR_YEARS_TO_COME_80x80px.svg?VersionId=5yD4lwakyllbudh6faB1y2GLGmfMlnzL'
                ],
                [
                    'title' => 'CERTIFIED BODY-SAFE',
                    'description' => 'the highest standard of safety and construction',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_certified_for_your_pleasure_80x80.svg?VersionId=ixLK.NajfN3EZmAyr0rocl1tLW3E5gv2" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_certified_for_your_pleasure_80x80.svg?VersionId=ixLK.NajfN3EZmAyr0rocl1tLW3E5gv2',
                ],
                [
                    'title' => '8 SETTINGS',
                    'description' => 'from a teasing murmur to a satisfying pulse',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_8_SETTINGS_80x80px.svg?VersionId=g1U08GgNyOZSxA5lE1aBQp8gIc1x8W.c" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_8_SETTINGS_80x80px.svg?VersionId=g1U08GgNyOZSxA5lE1aBQp8gIc1x8W.c',
                ],
                [
                    'title' => 'SCULPTED FOR YOUR PLEASURE',
                    'description' => 'fits your body like a glove',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_SCULPTED_FOR_YOUR_PLEASUR_80x80px.svg?VersionId=7gplys5endYZO3Tu69xJWuWdqekA2SXK" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_SCULPTED_FOR_YOUR_PLEASUR_80x80px.svg?VersionId=7gplys5endYZO3Tu69xJWuWdqekA2SXK',
                ],
                [
                    'title' => '100% WATERPROOF',
                    'description' => 'perfect for the bath and shower',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_100__WATERPROOF_80x80px.svg?VersionId=SFvUVcvV1ZDuzz6PRPFK0FXbtGS_xJnZ" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_100__WATERPROOF_80x80px.svg?VersionId=SFvUVcvV1ZDuzz6PRPFK0FXbtGS_xJnZ',
                ],
                [
                    'title' => 'LONG-LASTING CHARGE',
                    'description' => 'longer time for pleasure',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/FEATURE_EXTRA_LONG-LASTING_CHARGE_80x80px.svg?VersionId=R8.a9brVGhosHLJnRImrbgXNwWDaQgH1" alt="Icon" src="https://assets.lelo.com/dx/2022-09/FEATURE_EXTRA_LONG-LASTING_CHARGE_80x80px.svg?VersionId=R8.a9brVGhosHLJnRImrbgXNwWDaQgH1',
                ],
            ]),

            'tech' => json_encode([
                [
                    'title' => '1 - ABSOLUTE PRECISION',
                    'description' => 'The pinpoint shape lets you meticulously stimulate any erogenous zone using the soft and bendable tip to steer the oscillations.',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/TECH_PRECISION_60x60px_1.svg?VersionId=jfMT24vWcMN0LCDqWTWkT9nHu6xFP3TK'
                ],
                [
                    'title' => '2 - EIGHT POWERFUL PLEASURE SETTINGS',
                    'description' => 'LELO DOT™ offers eight different vibration patterns, varying in intensity from a teasing murmur to a satisfying pulse.',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/TECH_8_SETTINGS_60x60px_0.svg?VersionId=sokVFWYJ5isa0i6YqysqFGHZVr4Ed87c'
                ],
                [
                    'title' => '3 - ELLIPTICAL MOVEMENT',
                    'description' => 'Elliptical movement for a completely new unique sensation, reinventing orgasms as we know them.',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/TECH_INFINITY_60x60px_0.svg?VersionId=TjK8ai2uQ2sSdMCBU_JrjclbKo5Hymr8'
                ],
                [
                    'title' => '4 - EXTRA-SOFT SILICONE',
                    'description' => 'Ultra-smooth premium silicone that’s extra soft to the touch. LELO’s classic body-safe silicone design allows for deeply fulfilling and hygienic pleasure.',
                    'icon' => 'https://assets.lelo.com/dx/2022-09/TECH_EXTRA-SOFT_SILICONE_60x60px_0.svg?VersionId=F9IJxNfR2lawdz0tj4dWU3PoolNUiSzq'
                ]
            ]),
            // 'how_to_use' => '<div class="layout__region layout__region--content"><div id="howtouse" spy-title="HOW TO USE" style="color:#fff" class="block block-layout-builder block-inline_block how-to-use-block how_to_use_block layout--slider slider-blocked scrollspy"><div class="container how-to-use-container"><div class="field_how_to_use_tagline"><h6 style="color:#fff">HOW TO USE</h6></div><div class="swiper-how-to-use-container swiper-container-initialized swiper-container-horizontal swiper-container-pointer-events"><div class="how-to-use__wrapper swiper-wrapper" id="swiper-wrapper-a7f6d45c68e35de8" aria-live="polite" style="transform:translate3d(0,0,0)"><div class="how-to-use-slider-item swiper-slide active swiper-slide-active" style="width:297.5px" role="group" aria-label="1 / 3"><div class="image-container"><div class="items-counter">1</div><picture><source media="(max-width: 575px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_1_298x298px_DOT.jpg?VersionId=U6DrUQ1GozU2_XOL_ftQBWFErqTR780r" srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_1_298x298px_DOT.jpg?VersionId=U6DrUQ1GozU2_XOL_ftQBWFErqTR780r" class="animate"><source media="(min-width: 576px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_1_350x350px_DOT.jpg?VersionId=Lkl1vWoZMCGccXZTw6R8ZWjdCnwaysia" srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_1_350x350px_DOT.jpg?VersionId=Lkl1vWoZMCGccXZTw6R8ZWjdCnwaysia" class="animate"><img data-src="https://assets.lelo.com/dx/2022-09/HTU_desktop_1_350x350px_DOT.jpg?VersionId=Lkl1vWoZMCGccXZTw6R8ZWjdCnwaysia"></picture></div><div class="text-container"><div class="field_how_to_use_subtitle"><h3 style="color:#fff">STEP 1</h3></div><div class="field_how_to_use_title"><h2 style="color:#fff">Prep</h2></div><div class="field_how_to_use_body"><div class="body"><p>Apply LELO Personal Moisturizer on the very tip of your LELO DOT™ and any surface pleasure spot you plan on focusing. Think clitoris, nipples, neck - any place that gets your juices flowing.</p></div></div></div></div><div class="how-to-use-slider-item swiper-slide faded swiper-slide-next" style="width:297.5px" role="group" aria-label="2 / 3"><div class="image-container"><div class="items-counter">2</div><picture><source media="(max-width: 575px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_2_298x298px_DOT.jpg?VersionId=qTIFF01X1jaoxmSuAGAQpxNFREcQasV6" srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_2_298x298px_DOT.jpg?VersionId=qTIFF01X1jaoxmSuAGAQpxNFREcQasV6" class="animate"><source media="(min-width: 576px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_2_350x350px_DOT.jpg?VersionId=_Ifz0WoDu3ldgdDn6cHCKmEcr_yDVWVh" srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_2_350x350px_DOT.jpg?VersionId=_Ifz0WoDu3ldgdDn6cHCKmEcr_yDVWVh" class="animate"><img class="animate" data-src="https://assets.lelo.com/dx/2022-09/HTU_desktop_2_350x350px_DOT.jpg?VersionId=_Ifz0WoDu3ldgdDn6cHCKmEcr_yDVWVh" loading="lazy" src="https://assets.lelo.com/dx/2022-09/HTU_desktop_2_350x350px_DOT.jpg?VersionId=_Ifz0WoDu3ldgdDn6cHCKmEcr_yDVWVh"></picture></div><div class="text-container"><div class="field_how_to_use_subtitle"><h3 style="color:#fff">STEP 2</h3></div><div class="field_how_to_use_title"><h2 style="color:#fff">Engage</h2></div><div class="field_how_to_use_body"><div class="body"><p>Once comfortable, press the () button to turn it on. Use the () to switch between the eight pleasure settings. Once ready, focus on your clitoris, and let the movements of LELO DOT™ guide you.</p></div></div></div></div><div class="how-to-use-slider-item swiper-slide faded" style="width:297.5px" role="group" aria-label="3 / 3"><div class="image-container"><div class="items-counter">3</div><picture><source media="(max-width: 575px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_3_298x298px_DOT.jpg?VersionId=mtrCi_iZdjwnYZdx6VK0FvUZkndduqeI" srcset="https://assets.lelo.com/dx/2022-09/HTU_mobile_3_298x298px_DOT.jpg?VersionId=mtrCi_iZdjwnYZdx6VK0FvUZkndduqeI" class="animate"><source media="(min-width: 576px)" data-srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_3_350x350px_DOT.jpg?VersionId=3GS98BYtIoQyyAvR1VZ1FWIgWwlFpWLg" srcset="https://assets.lelo.com/dx/2022-09/HTU_desktop_3_350x350px_DOT.jpg?VersionId=3GS98BYtIoQyyAvR1VZ1FWIgWwlFpWLg" class="animate"><img class="animate" data-src="https://assets.lelo.com/dx/2022-09/HTU_desktop_3_350x350px_DOT.jpg?VersionId=3GS98BYtIoQyyAvR1VZ1FWIgWwlFpWLg" loading="lazy" src="https://assets.lelo.com/dx/2022-09/HTU_desktop_3_350x350px_DOT.jpg?VersionId=3GS98BYtIoQyyAvR1VZ1FWIgWwlFpWLg"></picture></div><div class="text-container"><div class="field_how_to_use_subtitle"><h3 style="color:#fff">STEP 3</h3></div><div class="field_how_to_use_title"><h2 style="color:#fff">Indulge</h2></div><div class="field_how_to_use_body"><div class="body"><p>LELO DOT™ delivers intuitive strength and intensity, depending on the applied pressure and angle of use. Experiment with different positions and see which angle suits you the best.</p></div></div></div></div></div><span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div></div><div class="helper-class"><span class="helper-inline-blockhow-to-use-block"></span></div></div></div>',
            'featured_image' => 'product-1.jpg',
            'images' => json_encode([
                'https://assets.lelo.com/dx/2022-09/Tehnologies_image_trans_openTehnologies_image_desktop_730x730px_DOT_1.png?VersionId=jxFtzKue.DzbBWRtRlsYT1XSmmqyavJ.',
                'https://assets.lelo.com/dx/product-images/2022-08/LELO_DOT_Packaging_Pink_425.jpg?VersionId=BjIRo9bH39hS7IIZ0QaI.nwYdaxX.iW4',
                'https://assets.lelo.com/dx/product-images/2022-08/LELO_DOT_OpenPack_Pink_425.jpg?VersionId=HLKCDwPgYedlON4IjTR1DaBMb1IIISzV',
                'https://assets.lelo.com/dx/product-images/2022-08/LELO_DOT_BackPackaging_425.jpg?VersionId=gTJoSeAES2IYjkU46NrBW9P7ndTuF2nA',
            ]),
            'created_at' => now()
        ];
        
        foreach ($products as $product) {
            DB::table('products')->insert($product);
        }

        // for ($i = 1; $i <= 21; $i++) {
        //     $images = [
        //         'product-' . $i . '_1.jpg',
        //         'product-' . $i . '_2.jpg',
        //         'product-' . $i . '_3.jpg',
        //         'product-' . $i . '_4.jpg',
        //         'product-' . $i . '_5.jpg',
        //         'product-' . $i . '_6.jpg',
        //         'product-' . $i . '_7.jpg',
        //         'product-' . $i . '_8.jpg'
        //     ];

        //     DB::table('products')->insert([
        //         'name' => 'Product ' . $i,
        //         'slug' => 'product-' . $i,
        //         'details' => '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p> <ul><li>Any Product types that You want - Simple, Configurable</li><li>Downloadable/Digital Products, Virtual Products</li><li>Inventory Management with Backordered items</li></ul><p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>',
        //         'price' => number_format((mt_rand(1099, 9999) / 100), 2, '.', ''),
        //         'description' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
        //         'featured_image' => 'product-' . $i . '.jpg',
        //         'images' => json_encode($images),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]);
        // }
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
