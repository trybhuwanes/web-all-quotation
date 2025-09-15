<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Pic\OrderAttachmentController;
use App\Http\Controllers\Admin\ProjectController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes      your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Back
Route::middleware('auth')->group(function () {

    // After login
    Route::get('product-overview/{slug}/specification', [App\Http\Controllers\ProductsController::class, 'specification'])->name('product-overview.specification');
    Route::get('product-overview/{slug}/download-brosur', [App\Http\Controllers\ProductsController::class, 'downloadBrosur'])->name('product-overview.brosur');
    Route::post('/count', [App\Http\Controllers\CountController::class, 'count'])->name('submit.count');

    // Admin routes
    Route::prefix('admin')->middleware(['role:admin,pic'])->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/dashboard/sales', [App\Http\Controllers\Admin\AdminController::class, 'getSales'])->name('admin.dashboard.getsales');
        Route::get('/dashboard/salespic', [App\Http\Controllers\Admin\AdminController::class, 'getSalesPic'])->name('admin.dashboard.getsalespic');
        Route::get('/dashboard/productsale', [App\Http\Controllers\Admin\AdminController::class, 'getOrderStatus'])->name('admin.dashboard.getorderstatus');
        Route::get('/dashboard/salerevenuepic', [App\Http\Controllers\Admin\AdminController::class, 'getRevenuePic'])->name('admin.dashboard.getrevenuepic');

        Route::resource('alluser', App\Http\Controllers\Admin\UserController::class);
        Route::resource('user-pic', App\Http\Controllers\Admin\PicuserController::class)->only(['create', 'store']);
        Route::put('/change-pass/{userid}', [App\Http\Controllers\Admin\ChangesignacountController::class, 'updatePass'])->name('admin.update.pass');
        Route::put('/change-mail/{userid}', [App\Http\Controllers\Admin\ChangesignacountController::class, 'updateMail'])->name('admin.update.mail');

        Route::get('select2/item-category', [App\Http\Controllers\Select2Controller::class, 'itemCategory'])->name('select2.item-category');
        Route::get('select2/item-product-main', [App\Http\Controllers\Select2Controller::class, 'itemProductmain'])->name('select2.item-productmain');
        Route::get('select2/item-pic', [App\Http\Controllers\Select2Controller::class, 'userPic'])->name('select2.item-pic');

        // Kategori Product
        Route::resource('kategori-product', App\Http\Controllers\Admin\KategoriproductController::class);

        // Target
        Route::resource('targets', App\Http\Controllers\Admin\TargetController::class);

        // Product
        Route::resource('product', App\Http\Controllers\Admin\ProductController::class);
        Route::post('storage-dropzone-img', [App\Http\Controllers\Admin\ProductController::class, 'storageDropzoneImg'])->name('storage-dropzone-img');

        // Product Type
        Route::get('/product-type/{productId}/create', [App\Http\Controllers\Admin\ProducttypeController::class, 'create'])->name('product.type.create');
        Route::post('/product-type/store', [App\Http\Controllers\Admin\ProducttypeController::class, 'store'])->name('product.type.store');
        Route::get('/product-type/{productId}/{typeId}/edit', [App\Http\Controllers\Admin\ProducttypeController::class, 'edit'])->name('product.type.edit');
        Route::put('/product-type/{productId}/{typeId}/update', [App\Http\Controllers\Admin\ProducttypeController::class, 'update'])->name('product.type.update');

        // Additional Product
        Route::resource('product-additional', App\Http\Controllers\Admin\AdditionalproductController::class);
        Route::post('storage-dropzone-img', [App\Http\Controllers\Admin\ProductController::class, 'storageDropzoneImg'])->name('storage-dropzone-img');

        // Order
        Route::resource('order-admin', App\Http\Controllers\Admin\OrderadminController::class)->only(['index', 'show', 'edit', 'update']);
        Route::get('/order-admin/{id}/send-email', [App\Http\Controllers\Admin\OrderadminController::class, 'sendEmailAndRedirect'])->name('admin.sendEmailAndRedirect');

        // Penentuan PIC
        Route::resource('deterimine-pic', App\Http\Controllers\Admin\DeterminepicController::class)->only(['index', 'show', 'update']);
        // PDF Export Quot
        Route::get('/exportquot-pdf/order-admin/{laporan}/{type}/{filename?}', [App\Http\Controllers\Admin\LaporanController::class, 'exportQoutationpdf'])->name('order-admin.export-quot-pdf');
        // PDF Order Detail
        Route::get('/export-pdf/order-admin/{laporan}', [App\Http\Controllers\Admin\LaporanController::class, 'exportPdf'])->name('order-admin.export-pdf');

        // Purchase Order
        Route::put('order-po/{id}', [App\Http\Controllers\Admin\DocpurchaseorderController::class, 'po'])->name('order-po');
        Route::post('storage-po-dropzone-pdf', [App\Http\Controllers\Admin\DocpurchaseorderController::class, 'storageDropzonePdf'])->name('storage-dropzone-pdf');

        Route::resource('revision-document', App\Http\Controllers\Admin\RevisionquotationController::class)->only(['store', 'show', 'edit', 'update']);
        Route::resource('shipping', App\Http\Controllers\Admin\ShippingController::class)->only(['store', 'show', 'edit', 'update']);
        Route::put('/shipping/{id}/update-weight', [App\Http\Controllers\Admin\ShippingController::class, 'updateWeight'])->name('shipping.updateWeight');
        Route::resource('term-payment', App\Http\Controllers\Admin\TermpaymentController::class)->only(['store', 'show', 'edit', 'update']);
        Route::put('/give-discount/{id}', [App\Http\Controllers\Admin\GivediscountController::class, 'update'])->name('give-discount.update');

        // Excel Order All
        Route::get('/export-excel/order-admin', [App\Http\Controllers\Admin\LaporanController::class, 'exportExcel'])->name('order-admin.export-excel');

        // Route Attachment
        Route::put('order-attachment/{id}', [App\Http\Controllers\Pic\OrderAttachmentController::class, 'store'])->name('order-attachment');
        Route::post('storage-attachment-dropzone-pdf', [App\Http\Controllers\Pic\OrderAttachmentController::class, 'storageDropzonePdf'])->name('storage-attachment-dropzone-pdf');
        Route::delete('/order/{id}/attachment', [OrderAttachmentController::class, 'destroy'])->name('order-attachment.destroy');

        // Route Project
        Route::resource('projects', ProjectController::class);

        // Route Profile
        Route::get('/profile', [ProfileController::class, 'edit'])->name('admin.profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('admin.profile.destroy');

        Route::get('/version', function () {
            return view('versiapps');
        })->name('versiapps.admin');
    });
    // End Admin routes

    // PIC routes
    Route::prefix('pic')->middleware(['role:pic'])->group(function () {

        Route::get('/dashboard', [App\Http\Controllers\Pic\PicController::class, 'dashboard'])->name('pic.dashboard');

        Route::get('/dashboard/sales', [App\Http\Controllers\Pic\PicController::class, 'getSales'])->name('pic.dashboard.getsales');
        Route::get('/dashboard/revenuepic', [App\Http\Controllers\Pic\PicController::class, 'getRevenuePic'])->name('pic.dashboard.getrevenuepic');

        // Products
        Route::resource('product', App\Http\Controllers\Pic\ProductpicController::class)->names('picproduct');
        Route::get('/product-type/{productId}/{typeId}/edit', [App\Http\Controllers\Pic\ProducttypepicController::class, 'edit'])->name('picproduct.type.edit');
        Route::put('/product-type/{productId}/{typeId}/update', [App\Http\Controllers\Pic\ProducttypepicController::class, 'update'])->name('picproduct.type.update');

        // Additional Product
        Route::resource('product-additional', App\Http\Controllers\Pic\AdditionalproductpicController::class)->names('picproduct-additional');;

        // Order
        Route::resource('order-pic', App\Http\Controllers\Pic\OrderpicController::class)->only(['index', 'show', 'edit', 'update']);
        Route::get('/order-pic/{id}/send-email', [App\Http\Controllers\Pic\OrderpicController::class, 'sendEmailAndRedirect'])->name('pic.sendEmailAndRedirect');

        Route::get('/order-pic/by-date/{date}', [App\Http\Controllers\Pic\PicController::class, 'byDate'])->name('orders.byDate');
        // ======================
        Route::resource('note-commercial', App\Http\Controllers\Pic\Notescommercial::class)->only(['store', 'show', 'edit', 'update']);
        Route::resource('revisions', App\Http\Controllers\Pic\RevisionquotController::class)->only(['store', 'show', 'edit', 'update']);
        Route::resource('shippings', App\Http\Controllers\Pic\ShippingsController::class)->only(['store', 'show', 'edit', 'update']);
        Route::resource('term-payments', App\Http\Controllers\Pic\TermpaymentsController::class)->only(['store', 'show', 'edit', 'update']);
        Route::put('/give-discounts/{id}', [App\Http\Controllers\Pic\GivediscountsController::class, 'update'])->name('give-discounts.update');

        Route::put('orders-po/{id}', [App\Http\Controllers\Pic\DocpurchaseordersController::class, 'po'])->name('orders-po');
        Route::post('storage-po-dropzone-pdfs', [App\Http\Controllers\Pic\DocpurchaseordersController::class, 'storageDropzonePdf'])->name('storage-dropzone-pdfs');

        // 
        Route::delete('/cart/del/{id}', [App\Http\Controllers\Pic\CartpicController::class, 'deleteFromCart'])->name('pic.cart.delete');
        Route::post('/cart/add-additional-product', [App\Http\Controllers\Pic\CartpicController::class, 'addAdditionalProductToCart'])->name('pic.cart.addAdditionalProduct');
        Route::put('/cart/update-additional-product/{id}', [App\Http\Controllers\Pic\CartpicController::class, 'updateAdditionalProductPrice'])->name('pic.cart.updateAdditionalProductPrice');

        // PDF Export Quot
        Route::get('/exportquot-pdf/order-pic/{laporan}/{type}/{filename?}', [App\Http\Controllers\Pic\QuotationController::class, 'exportQoutationpdf'])->name('order-pic.export-quot-pdf');

        // Route Attachment
        Route::put('orders-attachment/{id}', [App\Http\Controllers\Pic\OrderAttachmentController::class, 'store'])->name('orders-attachment');
        Route::post('storage-attachment-dropzone-pdfs', [App\Http\Controllers\Pic\OrderAttachmentController::class, 'storageDropzonePdf'])->name('storage-attachment-dropzone-pdfs');
        Route::delete('/orders/{id}/attachment', [OrderAttachmentController::class, 'destroy'])->name('orders-attachment.destroy');
    });
    // End PIC routes

    // Customer routes
    Route::middleware(['role:customer'])->group(function () {
        // Keranjang Customer
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
    });
    // End Customer routes
});

require __DIR__ . '/auth.php';

// Public routes
// Route::get('/', function () {
//     return view('index');
// })->name('welcome');

Route::get('about', [App\Http\Controllers\AboutusController::class, 'index'])->name('about-us');


Route::get('about-us', [App\Http\Controllers\AboutusController::class, 'index'])->name('about-us');
Route::get('contact-us', [App\Http\Controllers\ContactusController::class, 'index'])->name('contact-us');
Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);



// Produk
Route::get('product-overview', [App\Http\Controllers\ProductsController::class, 'index'])->name('product-overview.index');
Route::get('product-overview/{slug}', [App\Http\Controllers\ProductsController::class, 'detail'])->name('product-overview.detail');
Route::get('product-overview/{slug}/project', [App\Http\Controllers\ProductsController::class, 'project'])->name('product-overview.project');
Route::post('contact-us', [App\Http\Controllers\ContactusController::class, 'sendMail'])->name('contact-us-send');
Route::get('product-industry/{industry}', [App\Http\Controllers\ProductsController::class, 'industry'])->name('product.industry');
Route::get('/search', [App\Http\Controllers\SearchController::class, 'search'])->name('search.global');

Route::get('js/translations.js', [App\Http\Controllers\PortalController::class, 'translations'])->name('translations');


// Test Dihapus Nanti
Route::get('/send-email', [App\Http\Controllers\SendMailController::class, 'index'])->name('send');
Route::get('/storage-link', function () {
    Artisan::call('storage:link');
    return 'Storage link created successfully!';
});

Route::get('/clear-cache', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'Cache cleared!';
});

Route::get('/generate-ziggy', function () {
    Artisan::call('ziggy:generate');
    return 'Ziggy routes generated!';
});
