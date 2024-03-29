<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Color;
use App\Models\Tag;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        Paginator::useBootstrapFive();
        $links = [
            [
                'name' => 'Home',
                'route' => 'home',
            ],
            [
                'name' => 'Contact',
                'route' => 'contact',
            ],
            [
                'name' => 'Author',
                'route' => 'author',
            ],
        ];

        view()->share('links', $links);

        $sortings = [
            [
                'name' => 'Alphabetically ascending',
                'value' => 'a-z',
            ],
            [
                'name' => 'Alphabetically descending',
                'value' => 'z-a',
            ],
            [
                'name' => 'Price: Low to High',
                'value' => 'price-asc',
            ],
            [
                'name' => 'Price: High to Low',
                'value' => 'price-desc',
            ],
        ];
        $categories = Category::select('category_name', 'id')->get();
        $tags = Tag::select('tag_name', 'id')->get();
        $colors = Color::select('color_name', 'id')->get();
        $prices = [
            [
                'name' => '$0.00 - $50.00',
                'value' => '0-50',
            ],
            [
                'name' => '$50.00 - $100.00',
                'value' => '50-100',
            ],
            [
                'name' => '$100.00 - $150.00',
                'value' => '100-150',
            ],
            [
                'name' => '$150.00 - $200.00',
                'value' => '150-200',
            ],
            [
                'name' => '$200.00+',
                'value' => '200-1000',
            ],
        ];

        if (Session::has('authUser')) {
            $user = Session::get('authUser');
            view()->share('user', $user);
        }

        $slides = [
            [
                'image' => 'slide-01.jpg',
                'title' => 'New Arrivals',
                'description' => 'Check out our latest products',
            ],
            [
                'image' => 'slide-02.jpg',
                'title' => 'Summer Collection',
                'description' => 'Check out our latest products',
            ],
            [
                'image' => 'slide-03.jpg',
                'title' => 'Summer Collection',
                'description' => 'Check out our latest products',
            ],

        ];

        $banners = [
            [
                'title' => 'Women',
                'description' => 'Check out our latest products',
                'image' => 'banner-01.jpg',
            ],
            [
                'title' => 'Men',
                'description' => 'Check out our latest products',
                'image' => 'banner-02.jpg',
            ],
            [
                'title' => 'Accessories',
                'description' => 'Check out our latest products',
                'image' => 'banner-03.jpg',
            ],
        ];

        view()->share('slides', $slides);
        view()->share('prices', $prices);
        view()->share('tags', $tags);
        view()->share('colors', $colors);
        view()->share('categories', $categories);
        view()->share('banners', $banners);
        view()->share('sortings', $sortings);
    }

}
