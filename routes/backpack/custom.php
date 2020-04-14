<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    Route::crud('konten', 'KontenCrudController');
    Route::get('konten/{id}/confirm', 'KontenCrudController@confirm');
    Route::get('perpanjangan/{id}/diterima', 'PerpanjanganCrudController@Verifikasi');
    Route::crud('role', 'RoleCrudController');
    Route::crud('perkembangan', 'PerkembanganCrudController');
    Route::crud('donatur', 'DonaturCrudController');
    Route::crud('user', 'UserCrudController');
    Route::crud('perpanjangan', 'PerpanjanganCrudController');
}); // this should be the absolute last line of this file