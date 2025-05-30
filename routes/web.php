<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoutingController;

/* Master */
use App\Http\Controllers\Mstcustomer;
use App\Http\Controllers\Mstsupplier;
use App\Http\Controllers\DtexpController;
use App\Http\Controllers\DtprodController;
use App\Http\Controllers\DtbrandController;
use App\Http\Controllers\DtgroupController;
use App\Http\Controllers\DttypeController;
/* Transaction */
use App\Http\Controllers\RowInternalorder;
use App\Http\Controllers\Rowquotationorder;
use App\Http\Controllers\Rowpurchaseorder;
use App\Http\Controllers\Rowmutationout;
use App\Http\Controllers\Rowmutationin;
use App\Http\Controllers\Rowdelivery;
use App\Http\Controllers\Rowreturn;
use App\Http\Controllers\Rowsalesretail;
use App\Http\Controllers\Rowsaleservice;
/* cafee */
use App\Http\Controllers\CftableController;
use App\Http\Controllers\CfprodCotntroller;
use App\Http\Controllers\CfcashierController;
/* Website */
use App\Http\Controllers\Webcategory;
use App\Http\Controllers\Webclient;
use App\Http\Controllers\Webconfig;
use App\Http\Controllers\Webdownload;
use App\Http\Controllers\Webgallery;
use App\Http\Controllers\Weblog;
use App\Http\Controllers\Webnews;
use App\Http\Controllers\Webpromo;
use App\Http\Controllers\Webservice;
use App\Http\Controllers\Webstaff;
use App\Http\Controllers\Webvideo;
/* finance */
use App\Http\Controllers\Dtpaymethod;
use App\Http\Controllers\DtbankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'setting'], function () {
        Route::get('/profiles', App\Livewire\Mprofile\Index::class)->name('profiles.index');
    });
    Route::group(['prefix' => 'finance'], function () {
        Route::get('/paymethod', App\Livewire\Mpaymethod\Index::class)->name('paymethod.index');
        Route::post('/rwdata/paymethod', [Dtpaymethod::class, 'datatable']);

        Route::get('/bank', App\Livewire\Mbank\Index::class)->name('bank.index');
        Route::post('/rwdata/bank', [DtbankController::class, 'datatable']);
    });
      /*
    |--------------------------------------------------------------------------
    | Cafee
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'cafe'], function () {
        /* Cafee */
        Route::get('/tables', App\Livewire\Cafetable\Index::class)->name('cafetable.index');
        Route::post('/rwdata/tables', [CftableController::class, 'datatable']);

        Route::get('/products', App\Livewire\Cafeproduct\Index::class)->name('cfproducts.index');
        Route::get('/products/add', App\Livewire\Cafeproduct\Formadd::class)->name('cfproducts.add');
        Route::get('/products/edit/{id}', App\Livewire\Cafeproduct\FormEdit::class)->name('cfproducts.edit');
        Route::post('/rwdata/products', [CfprodCotntroller::class, 'datatable']);

        /* sales cashier */
        Route::get('/cashiers', App\Livewire\Cafecashier\Index::class)->name('cashiers.index');
        Route::get('/cashiers/add', App\Livewire\Cafecashier\Formadd::class)->name('cashiers.add');
        Route::get('/cashiers/edit/{id}', App\Livewire\Cafecashier\Formedit::class)->name('cashiers.edit');
        Route::get('/cashiers/print/{id}', App\Livewire\Cafecashier\Printdata::class)->name('cashiers.print');

        Route::post('/rwdata/cashiers', [CfcashierController::class, 'datatable']);
        Route::post('/rwdata/casave', [CfcashierController::class, 'save']);
        Route::post('/rwdata/caupdate', [CfcashierController::class, 'update']);

        /* Order item */
        Route::get('/orders', App\Livewire\Cafewaiters\Index::class)->name('orders.index');
        Route::get('/orders/add', App\Livewire\Cafewaiters\Formadd::class)->name('orders.add');
        Route::get('/orders/edit/{id}', App\Livewire\Cafewaiters\Formedit::class)->name('orders.edit');
        Route::get('/orders/print/{id}', App\Livewire\Cafewaiters\Printdata::class)->name('orders.print');

        Route::post('/rwdata/orders', [CfcashierController::class, 'datatable']);
    });

    /*
    |--------------------------------------------------------------------------
    | Master Profile
    |--------------------------------------------------------------------------
    */
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
        Route::post('/mstdata/supplier', [Mstsupplier::class, 'getDatasearch']);

        Route::get('/customers', App\Livewire\Mcustomer\Index::class)->name('customers.index');
        Route::get('/customers/add', App\Livewire\Mcustomer\Formadd::class)->name('customers.add');
        Route::get('/customers/edit/{id}', App\Livewire\Mcustomer\Formedit::class)->name('customers.edit');
        Route::post('/mstdata/customer', [Mstcustomer::class, 'getDatasearch']);

        Route::get('/expeditons', App\Livewire\Mexpedition\Index::class)->name('expeditons.index');
        Route::post('/rwdata/expeditons', [DtexpController::class, 'datatable']);
    });
    /*
    |--------------------------------------------------------------------------
    | Master Product
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'product'], function () {
        Route::get('/products', App\Livewire\Mproduct\Index::class)->name('products.index');
        Route::get('/products/add', App\Livewire\Mproduct\Formadd::class)->name('products.add');
        Route::get('/products/edit/{id}', App\Livewire\Mproduct\Formedit::class)->name('products.edit');
        Route::get('/prodsetting', App\Livewire\Mbrandproduct\Index::class)->name('prodsetting.index');

        Route::post('/rwdata/products', [DtprodController::class, 'datatable']);
        Route::post('/rwdata/getproduct', [DtprodController::class, 'getDetailProduct']);
        Route::post('/rwdata/searchproduct', [DtprodController::class, 'getSearchProduct']);

        Route::post('/rwdata/brands', [DtbrandController::class, 'datatable']);
        Route::post('/rwdata/groups', [DtgroupController::class, 'datatable']);
        Route::post('/rwdata/types', [DttypeController::class, 'datatable']);
    });
    /*
    |--------------------------------------------------------------------------
    | Transaction
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'inventory'], function () {
        /* Internal Order */
        Route::get('/intorder', App\Livewire\Trinternalord\Index::class)->name('intorder.index');
        Route::get('/intorder/add', App\Livewire\Trinternalord\Formadd::class)->name('intorder.add');
        Route::get('/intorder/edit/{id}', App\Livewire\Trinternalord\Formedit::class)->name('intorder.edit');
        Route::get('/intorder/print/{id}', App\Livewire\Trinternalord\Printdata::class)->name('intorder.print');
        /* Internal Order Ajax */
        Route::post('/rwdata/intorder', [RowInternalorder::class, 'datatable']);
        Route::post('/rwdata/iosave', [RowInternalorder::class, 'save']);
        Route::post('/rwdata/ioupdate', [RowInternalorder::class, 'update']);
        Route::post('/rwdata/ioapproved', [RowInternalorder::class, 'approved']);

        /* Quotation Order */
        Route::get('/quorder', App\Livewire\Trquotationord\Index::class)->name('quorder.index');
        Route::get('/quorder/add', App\Livewire\Trquotationord\Formadd::class)->name('quorder.add');
        Route::get('/quorder/edit/{id}', App\Livewire\Trquotationord\Formedit::class)->name('quorder.edit');
        Route::get('/quorder/print/{id}', App\Livewire\Trquotationord\Printdata::class)->name('quorder.print');
        /* Quotation Order Ajax */
        Route::post('/rwdata/quorder', [Rowquotationorder::class, 'datatable']);
        Route::post('/rwdata/qosave', [Rowquotationorder::class, 'save']);
        Route::post('/rwdata/qoupdate', [Rowquotationorder::class, 'update']);
        Route::post('/rwdata/qoapproved', [Rowquotationorder::class, 'approved']);
        /* Purchase Order */
        Route::get('/puorder', App\Livewire\Trpurchaseord\Index::class)->name('puorder.index');
        Route::get('/puorder/add', App\Livewire\Trpurchaseord\Formadd::class)->name('puorder.add');
        Route::get('/puorder/edit/{id}', App\Livewire\Trpurchaseord\Formedit::class)->name('puorder.edit');
        Route::get('/puorder/print/{id}', App\Livewire\Trpurchaseord\Printdata::class)->name('puorder.print');

        /* Purchase Order Ajax */
        Route::post('/rwdata/puorder', [Rowpurchaseorder::class, 'datatable']);
        Route::post('/rwdata/posave', [Rowpurchaseorder::class, 'save']);
        Route::post('/rwdata/poupdate', [Rowpurchaseorder::class, 'update']);
        Route::post('/rwdata/poapproved', [Rowpurchaseorder::class, 'approved']);

        Route::post('/rwdata/datatrans', [Rowpurchaseorder::class, 'getDatasearch']);
        /* Mutation Out */
        Route::get('/mutout', App\Livewire\Trmutationout\Index::class)->name('mutout.index');
        Route::get('/mutout/add', App\Livewire\Trmutationout\Formadd::class)->name('mutout.add');
        Route::get('/mutout/edit/{id}', App\Livewire\Trmutationout\Formedit::class)->name('mutout.edit');
        Route::get('/mutout/print/{id}', App\Livewire\Trmutationout\Printdata::class)->name('mutout.print');
        /* Mutation Out Ajax */
        Route::post('/rwdata/mutout', [Rowmutationout::class, 'datatable']);
        Route::post('/rwdata/mosave', [Rowmutationout::class, 'save']);
        Route::post('/rwdata/moupdate', [Rowmutationout::class, 'update']);
        Route::post('/rwdata/moapproved', [Rowmutationout::class, 'approved']);
        /* Mutation In */
        Route::get('/mutin', App\Livewire\Trmutationin\Index::class)->name('mutin.index');
        Route::get('/mutin/add', App\Livewire\Trmutationin\Formadd::class)->name('mutin.add');
        Route::get('/mutin/edit/{id}', App\Livewire\Trmutationin\Formedit::class)->name('mutin.edit');
        Route::get('/mutin/print/{id}', App\Livewire\Trmutationin\Printdata::class)->name('mutin.print');
        /* Mutation In Ajax */
        Route::post('/rwdata/mutin', [Rowmutationin::class, 'datatable']);
        Route::post('/rwdata/misave', [Rowmutationin::class, 'save']);
        Route::post('/rwdata/miupdate', [Rowmutationin::class, 'update']);
        Route::post('/rwdata/miapproved', [Rowmutationin::class, 'approved']);
    });

    /*
    |--------------------------------------------------------------------------
    | Sales
    |--------------------------------------------------------------------------
    */
    Route::group(['prefix' => 'sales'], function () {
        /* Delivery */
        Route::get('/delivery', App\Livewire\Trdeliveryord\Index::class)->name('delivery.index');
        Route::get('/delivery/add', App\Livewire\Trdeliveryord\Formadd::class)->name('delivery.add');
        Route::get('/delivery/edit/{id}', App\Livewire\Trdeliveryord\Formedit::class)->name('delivery.edit');
        Route::get('/delivery/print/{id}', App\Livewire\Trdeliveryord\Printdata::class)->name('delivery.print');
        /* Delivery In Ajax */
        Route::post('/rwdata/delivery', [Rowdelivery::class, 'datatable']);
        Route::post('/rwdata/dosave', [Rowdelivery::class, 'save']);
        Route::post('/rwdata/doupdate', [Rowdelivery::class, 'update']);
        Route::post('/rwdata/doapproved', [Rowdelivery::class, 'approved']);
        /* Delivery */
        Route::get('/return', App\Livewire\Trreturnord\Index::class)->name('return.index');
        Route::get('/return/add', App\Livewire\Trreturnord\Formadd::class)->name('return.add');
        Route::get('/return/edit/{id}', App\Livewire\Trreturnord\Formedit::class)->name('return.edit');
        Route::get('/return/print/{id}', App\Livewire\Trreturnord\Printdata::class)->name('return.print');
        /* Delivery In Ajax */
        Route::post('/rwdata/return', [Rowreturn::class, 'datatable']);
        Route::post('/rwdata/rnsave', [Rowreturn::class, 'save']);
        Route::post('/rwdata/rnupdate', [Rowreturn::class, 'update']);
        Route::post('/rwdata/rnapproved', [Rowreturn::class, 'approved']);
         /* sales Retail */
        Route::get('/retail', App\Livewire\Trsalesretail\Index::class)->name('retail.index');
        Route::get('/retail/add', App\Livewire\Trsalesretail\Formadd::class)->name('retail.add');
        Route::get('/retail/edit/{id}', App\Livewire\Trsalesretail\Formedit::class)->name('retail.edit');
        Route::get('/retail/print/{id}', App\Livewire\Trsalesretail\Printdata::class)->name('retail.print');
        /* Delivery In Ajax */
        Route::post('/rwdata/retail', [Rowsalesretail::class, 'datatable']);
        Route::post('/rwdata/rtsave', [Rowsalesretail::class, 'save']);
        Route::post('/rwdata/rtupdate', [Rowsalesretail::class, 'update']);
        Route::post('/rwdata/searchsales', [Rowsalesretail::class, 'getSearchsales']);
        Route::post('/rwdata/getitemsales', [Rowsalesretail::class, 'getItemsales']);

        /* sales service */
        Route::get('/service', App\Livewire\Trsaleservice\Index::class)->name('service.index');
        Route::get('/service/add', App\Livewire\Trsaleservice\Formadd::class)->name('service.add');
        Route::get('/service/edit/{id}', App\Livewire\Trsaleservice\Formedit::class)->name('service.edit');
        Route::get('/service/print/{id}', App\Livewire\Trsaleservice\Printdata::class)->name('service.print');
        /* Delivery In Ajax */
        Route::post('/rwdata/service', [Rowsaleservice::class, 'datatable']);
        Route::post('/rwdata/svsave', [Rowsaleservice::class, 'save']);
        Route::post('/rwdata/svupdate', [Rowsaleservice::class, 'update']);
    });

    Route::group(['prefix' => 'website'], function () {
        Route::get('/configs', App\Livewire\Webconfig\Index::class)->name('configs.index');
        Route::get('/category', App\Livewire\Webcategory\Index::class)->name('webcategory.index');
        Route::get('/clients', App\Livewire\Webclient\Index::class)->name('clients.index');
        Route::get('/downloads', App\Livewire\Webdownload\Index::class)->name('downloads.index');
        Route::get('/gallerys', App\Livewire\Webgallery\Index::class)->name('gallerys.index');
        Route::get('/news', App\Livewire\Webnews\Index::class)->name('news.index');
        Route::get('/promos', App\Livewire\Webpromo\Index::class)->name('promos.index');
        Route::get('/services', App\Livewire\Webservice\Index::class)->name('services.index');
        Route::get('/staffs', App\Livewire\Webstaff\Index::class)->name('staffs.index');
        Route::get('/videos', App\Livewire\Webvideo\Index::class)->name('Videos.index');
        /* Website Ajax */
        Route::post('/rwdata/category', [Webcategory::class, 'datatable']);
        Route::post('/rwdata/clients', [Webclient::class, 'datatable']);
        Route::post('/rwdata/configs', [Webconfig::class, 'datatable']);
        Route::post('/rwdata/downloads', [Webdownload::class, 'datatable']);
        Route::post('/rwdata/gallerys', [Webgallery::class, 'datatable']);
        Route::post('/rwdata/logs', [Weblog::class, 'datatable']);
        Route::post('/rwdata/news', [Webnews::class, 'datatable']);
        Route::post('/rwdata/promos', [Webpromo::class, 'datatable']);
        Route::post('/rwdata/services', [Webservice::class, 'datatable']);
        Route::post('/rwdata/staffs', [Webstaff::class, 'datatable']);
        Route::post('/rwdata/videos', [Webvideo::class, 'datatable']);
    });
});

Route::group(['prefix' => '/', 'middleware' => 'auth'], function () {
    Route::get('', [RoutingController::class, 'index'])->name('root');
    Route::get('{first}/{second}/{third}', [RoutingController::class, 'thirdLevel'])->name('third');
    Route::get('{first}/{second}', [RoutingController::class, 'secondLevel'])->name('second');
    Route::get('{any}', [RoutingController::class, 'root'])->name('any');

});
