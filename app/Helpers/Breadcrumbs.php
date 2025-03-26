<?php

use Illuminate\Support\Facades\Route;

if (!function_exists('getBreadcrumbs')) {
    function getBreadcrumbs()
    {
        $breadcrumbs = [];
        $routeName = Route::currentRouteName();

        switch ($routeName) {
            case 'admin.dashboard':
                $breadcrumbs = [
                    ['label' => 'Home', 'url' => route('admin.dashboard')],
                    ['label' => 'Dashboard', 'url' => route('admin.dashboard')],
                ];
                break;
            case 'categories.index':
                $breadcrumbs = [
                    ['label' => 'Home', 'url' => route('admin.dashboard')],
                    ['label' => 'Categories', 'url' => route('categories.index')],
                ];
                break;
            case 'products.index':
                $breadcrumbs = [
                    ['label' => 'Home', 'url' => route('admin.dashboard')],
                    ['label' => 'Products', 'url' => route('products.index')],
                ];
                break;
            case 'blogs.index':
                $breadcrumbs = [
                    ['label' => 'Home', 'url' => route('admin.dashboard')],
                    ['label' => 'Blogs', 'url' => route('blogs.index')],
                ];
                break;
            case 'profile.show':
                $breadcrumbs = [
                    ['label' => 'Home', 'url' => route('admin.dashboard')],
                    ['label' => 'User Profile', 'url' => route('profile.show')],
                ];
                break;
            default:
                // Add more routes if needed
                break;
        }

        return $breadcrumbs;
    }
}
