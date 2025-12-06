<?php

namespace Database\Seeders;

use Botble\Base\Supports\BaseSeeder;
use Botble\Blog\Models\Category;
use Botble\Blog\Models\Tag;
use Botble\Ecommerce\Models\Brand;
use Botble\Ecommerce\Models\ProductCategory;
use Botble\Ecommerce\Models\ProductTag;
use Botble\Menu\Database\Traits\HasMenuSeeder;
use Botble\Page\Models\Page;

class MenuSeeder extends BaseSeeder
{
    use HasMenuSeeder;

    public function run(): void
    {
        $data = [
            [
                'name' => 'Main menu',
                'slug' => 'main-menu',
                'location' => 'main-menu',
                'items' => [
                    [
                        'title' => 'Home',
                        'url' => '/',
                        'children' => [
                            [
                                'title' => 'Homepage',
                                'url' => '/',
                            ],
                            [
                                'title' => 'Homepage 2',
                                'reference_id' => 10,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 3',
                                'reference_id' => 11,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 4',
                                'reference_id' => 12,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 5',
                                'reference_id' => 13,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Homepage 6',
                                'reference_id' => 14,
                                'reference_type' => Page::class,
                            ],
                        ],
                    ],
                    [
                        'title' => 'Products',
                        'url' => '/products',
                    ],
                    [
                        'title' => 'Shop',
                        'url' => '#',
                        'children' => [
                            [
                                'title' => 'Product Category',
                                'reference_id' => 1,
                                'reference_type' => ProductCategory::class,
                            ],
                            [
                                'title' => 'Brand',
                                'reference_id' => 1,
                                'reference_type' => Brand::class,
                            ],
                            [
                                'title' => 'Product Tag',
                                'reference_id' => 1,
                                'reference_type' => ProductTag::class,
                            ],
                            [
                                'title' => 'Product Single',
                                'url' => 'products/beat-headphone',
                            ],
                        ],
                    ],
                    [
                        'title' => 'Blog',
                        'reference_id' => 3,
                        'reference_type' => Page::class,
                        'children' => [
                            [
                                'title' => 'Blog Left Sidebar',
                                'reference_id' => 3,
                                'reference_type' => Page::class,
                            ],
                            [
                                'title' => 'Blog Category',
                                'reference_id' => 1,
                                'reference_type' => Category::class,
                            ],
                            [
                                'title' => 'Blog Tag',
                                'reference_id' => 1,
                                'reference_type' => Tag::class,
                            ],
                            [
                                'title' => 'Blog Single',
                                'url' => 'blog/how-to-match-the-color-of-your-handbag-with-an-outfit',
                            ],
                        ],
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => 2,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Useful Links',
                'slug' => 'useful-links',
                'items' => [
                    [
                        'title' => 'About Us',
                        'reference_id' => 4,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'FAQ',
                        'reference_id' => 5,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Location',
                        'reference_id' => 6,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Affiliates',
                        'reference_id' => 7,
                        'reference_type' => Page::class,
                    ],
                    [
                        'title' => 'Contact',
                        'reference_id' => 2,
                        'reference_type' => Page::class,
                    ],
                ],
            ],
            [
                'name' => 'Categories',
                'slug' => 'categories',
                'items' => [
                    [
                        'title' => 'Television',
                        'reference_id' => 1,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Mobile',
                        'reference_id' => 2,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Headphone',
                        'reference_id' => 3,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Watches',
                        'reference_id' => 4,
                        'reference_type' => ProductCategory::class,
                    ],
                    [
                        'title' => 'Game',
                        'reference_id' => 5,
                        'reference_type' => ProductCategory::class,
                    ],
                ],
            ],
            [
                'name' => 'My Account',
                'slug' => 'my-account',
                'items' => [
                    [
                        'title' => 'My profile',
                        'url' => '/customer/overview',
                    ],
                    [
                        'title' => 'Wishlist',
                        'url' => '/wishlist',
                    ],
                    [
                        'title' => 'Orders',
                        'url' => 'customer/orders',
                    ],
                    [
                        'title' => 'Order tracking',
                        'url' => '/orders/tracking',
                    ],
                ],
            ],
        ];

        $this->createMenus($data);
    }
}
