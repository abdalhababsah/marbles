<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});




Breadcrumbs::for('brands.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Brands', route('catalog.brands.index'));
});
Breadcrumbs::for('categories.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Categories', route('catalog.categories.index'));
});
Breadcrumbs::for('products.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('products', route('catalog.products.index'));
});
Breadcrumbs::for('variant_types.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Variant Types', route('catalog.variant-types.index'));
});
Breadcrumbs::for('home-images.index', function ($trail) {
    $trail->parent('home');
    $trail->push('Home Images', route('home.home-images.index'));
});
Breadcrumbs::for('about-us.index', function ($trail) {
    $trail->parent('home');
    $trail->push('About Us', route('home.about-us.index'));
});
Breadcrumbs::for('contact-us.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Contact Us', route('home.contact-us.index'));
});