<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

use App\Http\Controllers\DtexpController;
use App\Http\Controllers\DtprodController;
use App\Http\Controllers\DtbrandController;
use App\Http\Controllers\DtgroupController;
use App\Http\Controllers\DttypeController;

use App\Http\Controllers\WebCategory;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
*/

require __DIR__ . '/auth.php';
/* Employee */
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/profiles', App\Livewire\Mprofile\Index::class)->name('profiles.index');
    });
    Route::group(['prefix' => 'profile'], function () {/* Companies */
        Route::get('/companies', App\Livewire\Mcompanie\Index::class)->name('companies.index');
        Route::get('/companies/add', App\Livewire\Mcompanie\Formadd::class)->name('companies.add');
        Route::get('/companies/edit/{id}', App\Livewire\Mcompanie\FormEdit::class)->name('companies.edit');
        /* region */
        Route::get('/regions', App\Livewire\Mregion\Index::class)->name('regions.index');
        Route::get('/regions/add', App\Livewire\Mregion\FormAdd::class)->name('regions.add');
        Route::get('/regions/edit/{id}', App\Livewire\Mregion\FormEdit::class)->name('regions.edit');
        /* depart */
        Route::get('/departs', App\Livewire\Mdepart\Index::class)->name('departs.index');
    });
    Route::group(['prefix' => 'master'], function () {
        Route::get('/employees', App\Livewire\Memployee\Index::class)->name('employees.index');
        Route::get('/employees/add', App\Livewire\Memployee\Formadd::class)->name('employees.add');
        Route::get('/employees/edit/{id}', App\Livewire\Memployee\Formedit::class)->name('employees.edit');

        Route::get('/suppliers', App\Livewire\Msupplier\Index::class)->name('suppliers.index');
        Route::get('/suppliers/add', App\Livewire\Msupplier\Formadd::class)->name('suppliers.add');
        Route::get('/suppliers/edit/{id}', App\Livewire\Msupplier\Formedit::class)->name('suppliers.edit');

        Route::get('/customers', App\Livewire\Mcustomer\Index::class)->name('customers.index');
        Route::get('/customers/add', App\Livewire\Mcustomer\Formadd::class)->name('customers.add');
        Route::get('/customers/edit/{id}', App\Livewire\Mcustomer\Formedit::class)->name('customers.edit');

        Route::get('/expeditons', App\Livewire\Mexpedition\Index::class)->name('expeditons.index');
        Route::post('/rwdata/expeditons', [DtexpController::class, 'datatable']);
    });
    Route::group(['prefix' => 'product'], function () {
        Route::get('/products', App\Livewire\Mproduct\Index::class)->name('products.index');
        Route::get('/products/add', App\Livewire\Mproduct\Formadd::class)->name('products.add');
        Route::get('/products/edit/{id}', App\Livewire\Mproduct\Formedit::class)->name('products.edit');

        Route::get('/prodsetting', App\Livewire\Mbrandproduct\Index::class)->name('prodsetting.index');

        Route::post('/rwdata/products', [DtprodController::class, 'datatable']);
        Route::post('/rwdata/brands', [DtbrandController::class, 'datatable']);
        Route::post('/rwdata/groups', [DtgroupController::class, 'datatable']);
        Route::post('/rwdata/types', [DttypeController::class, 'datatable']);
    });

     Route::group(['prefix' => 'website'], function () {
        Route::get('/category', App\Livewire\WebCategory\Index::class)->name('webcategory.index');
        Route::post('/rwdata/category', [WebCategory::class, 'datatable']);
     });
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');

});
