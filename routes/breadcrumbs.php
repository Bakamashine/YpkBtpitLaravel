<?php

use App\Models\Product;
use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('main', function (BreadcrumbTrail $trail) {
    $trail->push('Главная', route('main'));
});

Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->parent('main');
    $trail->push('Профиль', route('home'));
});

Breadcrumbs::for('user_edit', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Редактирование профиля', route('user_edit'));
});

Breadcrumbs::for('product.edit_page', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Управление товарами', route('product.edit_page'));
});

Breadcrumbs::for('product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('product.edit_page');
    $trail->push('Создание товара/услуги', route('product.create'));
});

Breadcrumbs::for('product.show', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('main');
    $trail->push($product->product_name, route('product.show', $product));
});

Breadcrumbs::for('product.edit', function (BreadcrumbTrail $trail, Product $product) {
    $trail->parent('product.edit_page');
    $trail->push('Редактирование: ' . $product->product_name, route('product.edit', $product));
});

Breadcrumbs::for('user_management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Управление пользователями', route('user_management.index'));
});

Breadcrumbs::for('user_management.create', function (BreadcrumbTrail $trail) {
    $trail->parent('user_management.index');
    $trail->push('Создание пользователя', route('user_management.create'));
});

Breadcrumbs::for('user_management.edit', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user_management.index');
    $trail->push('Редактирование: ' . $user->name, route('user_management.edit', $user));
});
