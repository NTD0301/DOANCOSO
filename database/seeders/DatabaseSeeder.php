<?php

namespace Database\Seeders;

use App\Models\{Banner, Brand, Comment, Order, OrderItem, Post, PostCategory, Product, ProductCategory, User};
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1) Admin cố định
        $adminEmail = 'admin@gmail.com';
        User::firstOrCreate([ 'email' => $adminEmail, ], [ 'name' => 'Quản trị viên', 'password' => Hash::make('123456'), 'role' => 'admin', ]);

        // 2) Users random
        $users = User::factory()->count(5)->create();

        // 3) Categories theo cây (dùng factory state)
        $leafCategories = $this->seedProductCategoriesByFactory();

        // 4) Brands fixed list nhưng tạo bằng factory
        $brands = $this->seedBrandsByFactory();

        // // 5) Products random + gán FK random
        // Product::factory()
        //     ->count(16)
        //     ->make()
        //     ->each(function ($product) use ($leafCategories, $brands) {
        //         $product->product_category_id = $leafCategories->random()->id;
        //         $product->brand_id = $brands->random()->id;
        //         $product->save();
        //     });

        // 6) Post categories fixed list bằng factory
        $postCategories = PostCategory::factory()
            ->sequence(
                ['name' => 'Tin tức', 'slug' => 'tin-tuc', 'description' => 'Cập nhật thông tin mới nhất về các loại bánh và tiệm bánh'],
                ['name' => 'Khuyến mãi', 'slug' => 'khuyen-mai', 'description' => 'Những ưu đãi và chương trình giảm giá dành cho khách hàng'],
            )
            ->count(2)
            ->create();

        // 7) Banners fixed list bằng factory sequence
        Banner::factory()
            ->sequence(
                [
                    'title' => 'Bánh kem sinh nhật - Giảm giá đến 20%',
                    'image' => 'banners/1.webp',
                    'url' => '#',
                    'sort_order' => 1,
                    'is_active' => true,
                    'is_small' => false,
                ],
                [
                    'title' => 'Combo bánh ngọt cuối tuần - Mua 2 tặng 1',
                    'image' => 'banners/2.webp',
                    'url' => '#',
                    'sort_order' => 2,
                    'is_active' => true,
                    'is_small' => false,
                ],
                [
                    'title' => 'Mua 1 tặng 1 - Ưu đãi đặc biệt cho khách hàng thân thiết',
                    'image' => 'banners/3.webp',
                    'url' => '#',
                    'sort_order' => 3,
                    'is_active' => true,
                    'is_small' => false,
                ],
            )
            ->count(3)
            ->create();

        // // 8) Posts random
        // Post::factory()
        //     ->count(8)
        //     ->for($postCategories->random(), 'category') // nếu relation tên category()
        //     ->create();

        // 9) Comments random bằng factory (xem factory mẫu dưới)
        // Comment::factory()->count(10)->create();

        // 10) Order demo bằng factory (xem factory mẫu dưới)
        // $order = Order::factory()
        //     ->paid()
        //     ->for($users->first(), 'user')
        //     ->create();

        // items + total
        // $productsDemo = Product::inRandomOrder()->take(3)->get();
        // $total = 0;
        // foreach ($productsDemo as $p) {
        //     $qty = rand(1,3);
        //     OrderItem::factory()->create([
        //         'order_id' => $order->id,
        //         'product_id' => $p->id,
        //         'quantity' => $qty,
        //         'price' => $p->price,
        //     ]);
        //     $total += $p->price * $qty;
        // }
        // $order->update(['total_amount' => $total]);
    }

    private function seedBrandsByFactory()
    {
        $arrs = [
            ['name'=>'Tous Les Jours', 'description'=>''],
            ['name'=>'Paris Baguette', 'description'=>''],
            ['name'=>'ABC Bakery', 'description'=>''],
            ['name'=>'BreadTalk', 'description'=>''],
            ['name'=>'Givral', 'description'=>''],
            ['name'=>'Hỷ Lâm Môn', 'description'=>''],
            ['name'=>'OEM', 'description'=>''],
        ];

        return Brand::factory()
            ->count(count($arrs))
            ->sequence(fn($sequence) => [
                'name' => $arrs[$sequence->index]['name'],
                'slug' => Str::slug($arrs[$sequence->index]['name']),
                'description' => $arrs[$sequence->index]['description'],
                'website' => '#',
                'logo' => 'brands/200.png',
            ])
            ->create();
    }

private function seedProductCategoriesByFactory()
{
    $root = ProductCategory::factory()->count(4)->sequence(
        ['name'=>'Bánh nướng', 'slug'=>'banh-nuong','description'=>'...', 'depth'=>1],
        ['name'=>'Khác', 'slug'=>'khac','description'=>'...', 'depth'=>1],
        ['name'=>'Bánh ngọt', 'slug'=>'banh-ngot','description'=>'...', 'depth'=>1],
        ['name'=>'Bánh lạnh', 'slug'=>'banh-lanh','description'=>'...', 'depth'=>1],
    )->create();

    $lvl2 = collect([
        $root[0]->children()->saveMany(
            ProductCategory::factory()->count(3)->sequence(
                ['name'=>'Croissant','slug'=>'croissant','depth'=>2],
                ['name'=>'Doughnut','slug'=>'doughnut','depth'=>2],
                ['name'=>'Muffin','slug'=>'muffin','depth'=>2],
            )->make()
        ),

        $root[2]->children()->saveMany(
            ProductCategory::factory()->count(3)->sequence(
                ['name'=>'Bánh kem','slug'=>'banh-kem','depth'=>2],
                ['name'=>'Bánh su kem','slug'=>'banh-su-kem','depth'=>2],
                ['name'=>'Tiramisu','slug'=>'tiramisu','depth'=>2],
            )->make()
        ),

        $root[3]->children()->saveMany(
            ProductCategory::factory()->count(2)->sequence(
                ['name'=>'Flan','slug'=>'flan','depth'=>2],
                ['name'=>'Pudding','slug'=>'pudding','depth'=>2],
            )->make()
        ),
    ])->flatten();

    $leaves = collect();

    return $leaves->values();
}
}
