<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


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

// Back
Route::middleware('auth')->group(function () {
    
    // After login
    Route::get('product-overview/{slug}/specification', [App\Http\Controllers\ProductsController::class, 'specification'])->name('product-overview.specification');
    Route::get('product-overview/{slug}/download-brosur', [App\Http\Controllers\ProductsController::class, 'downloadBrosur'])->name('product-overview.brosur');

    // Rute Admin
    Route::prefix('admin')->middleware(['role:admin'])->group(function () {
        Route::get('/dashboard', function () {
            $totalPIC = '';

            $totalGuest = '';
            
            $picData = '';

            // ============
            $categories = ['waste to energy',
                            'super closed water loop system',
                            'diac automation system',
                            'wwtp general',
                            'wtp and desalination',
                            'stp packaged',
                            'boldted tank and equipment',
                            'lainnya'];
            
            $data = '';


            // Gabungkan hasilnya dengan nama kategorinya
            $resultWithRoundedPercentages = '';
            $resultWithCountData = '';

            $colorBg = ['#018FFB','#00E296','#FEB018','#FF4460','#785DCE','#FF4E00','#E09664','#90b2c9'];

            return view('dashboard', compact('totalPIC', 'totalGuest', 'picData', 'resultWithRoundedPercentages', 'resultWithCountData', 'colorBg' ));
        })->name('admin.dashboard');

        // Select2 Option
        Route::get('select2/item-category', [App\Http\Controllers\Select2Controller::class, 'itemCategory'])->name('select2.item-category');
        Route::get('select2/item-product-main', [App\Http\Controllers\Select2Controller::class, 'itemProductmain'])->name('select2.item-productmain');
        
        // Kategori Product
        Route::resource('kategori-product', App\Http\Controllers\Admin\KategoriproductController::class);

        // Product
        Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
        Route::post('storage-dropzone-img', [App\Http\Controllers\Admin\ProductController::class, 'storageDropzoneImg'])->name('storage-dropzone-img');
        
        // Product Type
        Route::get('/product-type/{productId}/create', [App\Http\Controllers\Admin\ProducttypeController::class, 'create'])->name('product.type.create');
        Route::post('/product-type/store', [App\Http\Controllers\Admin\ProducttypeController::class, 'store'])->name('product.type.store');
        Route::get('/product-type/{productId}/{typeId}/edit', [App\Http\Controllers\Admin\ProducttypeController::class, 'edit'])->name('product.type.edit');
        Route::put('/product-type/{productId}/{typeId}/update', [App\Http\Controllers\Admin\ProducttypeController::class, 'update'])->name('product.type.update');
        // Route::resource('product-tipe', App\Http\Controllers\Admin\ProducttypeController::class);
        // Route::post('storage-dropzone-img', [App\Http\Controllers\Admin\ProducttypeController::class, 'storageDropzoneImg'])->name('storage-dropzone-img');

        // Additional Product
        Route::resource('product-additional', App\Http\Controllers\Admin\AdditionalproductController::class);
        // Route::post('storage-dropzone-img', [App\Http\Controllers\Admin\ProductController::class, 'storageDropzoneImg'])->name('storage-dropzone-img');

        Route::resource('alluser', App\Http\Controllers\Admin\UserController::class);
        // Route::get('select2/item-category', [App\Http\Controllers\Select2Controller::class, 'itemCategory'])->name('select2.item-category');

        // Order Admin
        Route::resource('order-admin', App\Http\Controllers\Admin\OrderadminController::class)->only(['index', 'show', 'edit', 'update']);;


        // PDF Order Detail
        Route::get('/exportquot-pdf/order-admin/{laporan}', [App\Http\Controllers\Admin\LaporanController::class, 'exportQoutationpdf'])->name('order-admin.export-quot-pdf');


        // PDF Order Detail
        Route::get('/export-pdf/order-admin/{laporan}', [App\Http\Controllers\Admin\LaporanController::class, 'exportPdf'])->name('order-admin.export-pdf');
        
        // Excel Order All
        Route::get('/export-excel/order-admin', [App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])->name('order-admin.export-excel');
        // // Presensi
        // Route::resource('presensi', App\Http\Controllers\Admin\PresensiController::class)->only(['index', 'show', 'edit']);

        // Penentuan Pic
        // Route::resource('pic', App\Http\Controllers\Admin\PenentuanpicController::class)->only(['index', 'store', 'edit']);

        // Create Pic
        // Route::resource('user-pic', App\Http\Controllers\Admin\PicuserController::class)->only(['create', 'store', 'edit']);

        // Laporan
        // Route::resource('laporan', App\Http\Controllers\Admin\LaporanController::class)->except(['edit', 'update', 'destroy']);
        // Route::get('/export-excel/laporan', [App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])->name('admin.laporan.export-excel');

        // Route::get('/export-excel', function() {
        //     return 'Test route is working';
        // });

        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

        Route::get('/version', function () {
            return view('versiapps');
        })->name('versiapps.admin');
        
    });



    // Rute untuk pic
    Route::middleware(['role:pic'])->group(function () {
        // Route::get('/dashboard', function () {
        //     $clientStats = DB::table('report_presensi')
        //                     ->select(
        //                         DB::raw('count(case when user_id = ' . Auth::id() . ' then 1 end) as total_handle'),
        //                         DB::raw('count(presensi_id) as total_clients')
        //                     )->first();

        //     return view('dashboard', compact('clientStats'));
        // })->name('pic.dashboard');

        // Keranjang Customer
        // Route::get('cart', [App\Http\Controllers\Customer\CartuserController::class, 'index'])->name('cart.index');
        Route::resource('cart', App\Http\Controllers\Customer\CartuserController::class)->only(['index', 'destroy']);
        Route::post('/cart/add', [App\Http\Controllers\Customer\CartuserController::class, 'addToCart'])->name('cart.add');
        Route::delete('/cart/del/{id}', [App\Http\Controllers\Customer\CartuserController::class, 'deleteFromCart'])->name('cart.delete');
        
        Route::post('/cart/add-additional-product', [App\Http\Controllers\Customer\CartuserController::class, 'addAdditionalProductToCart'])->name('cart.addAdditionalProduct');
        Route::post('/cart/update-quantity', [App\Http\Controllers\Customer\CartuserController::class, 'updateQuantity'])->name('cart.updateQuantity');
        
        // Proses Pesanan Customer 
        Route::post('/checkout', [App\Http\Controllers\Customer\OrderController::class, 'checkout'])->name('checkout.process');
        
        
        
        // Detail Pesanan
        Route::get('/order/{code}', [App\Http\Controllers\Customer\OrderController::class, 'orderDetail'])->name('order.detail');
        Route::get('/order', [App\Http\Controllers\Customer\OrderController::class, 'myOrder'])->name('myorder.all');

        
        
        // Gak sido
        Route::get('/checkout/thankyou', [App\Http\Controllers\Customer\OrderController::class, 'thankyou'])->name('checkout.thankyou');

        // Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity']);

        // Client
        // Route::resource('client', App\Http\Controllers\Pic\ClientController::class)->only(['index', 'store', 'show', 'edit', 'update']);

        // Route::resource('discus', App\Http\Controllers\Pic\IsidiskusiController::class)->only(['index', 'store', 'edit']);
        Route::get('/version', function () {
            return view('versiapps');
        })->name('versiapps.pic');
    });
});

require __DIR__ . '/auth.php';

Route::get('/migrate-fresh-seed', function () {
    Artisan::call('migrate:fresh --seed');
    return "Migration and Seeding completed!";
});


// Front
Route::get('/', function () {
    return view('index');
})->name('welcome');



Route::get('about-us', [App\Http\Controllers\AboutusController::class, 'index'])->name('about-us');
Route::get('contact-us', [App\Http\Controllers\ContactusController::class, 'index'])->name('contact-us');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);


// Produk
Route::get('product-overview', [App\Http\Controllers\ProductsController::class, 'index'])->name('product-overview.index');
Route::get('product-overview/{slug}', [App\Http\Controllers\ProductsController::class, 'detail'])->name('product-overview.detail');







Route::get('/x', function () {
    return view('admin.order-admin.exports.import');
})->name('x');

Route::get('js/translations.js', [App\Http\Controllers\PortalController::class, 'translations'])->name('translations');
