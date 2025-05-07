<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

require __DIR__ . '/auth.php';

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');
});
/*
|--------------------------------------------------------------------------
| Profile Data
|--------------------------------------------------------------------------
*/
Route::get('/profiles', App\Livewire\Mprofile\Index::class)->name('profiles.index');
/* Companies */
Route::get('/companies', App\Livewire\Mcompanie\Index::class)->name('companies.index');
Route::get('/companies/add', App\Livewire\Mcompanie\Formadd::class)->name('companies.add');
Route::get('/companies/edit/{id}', App\Livewire\Mcompanie\FormEdit::class)->name('companies.edit');
/* region */
Route::get('/regions', App\Livewire\Mregion\Index::class)->name('regions.index');
Route::get('/regions/add', App\Livewire\Mregion\FormAdd::class)->name('regions.add');
Route::get('/regions/edit/{id}', App\Livewire\Mregion\FormEdit::class)->name('regions.edit');
/* depart */
Route::get('/departs', App\Livewire\Mdepart\Index::class)->name('departs.index');
/*
|--------------------------------------------------------------------------
| Master Data
|--------------------------------------------------------------------------
*/
/* Employee */
Route::get('/employees', App\Livewire\Mcompanie\Index::class)->name('employees.index');
Route::get('/employees/add', App\Livewire\Mcompanie\Formadd::class)->name('employees.add');
Route::get('/employees/edit/{id}', App\Livewire\Mcompanie\FormEdit::class)->name('employees.edit');



