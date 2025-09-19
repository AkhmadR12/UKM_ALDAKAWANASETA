<?php

use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BukuTamuController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesBarangContoller;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\EbookPageController;
use App\Http\Controllers\EbookUploadController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FormInputController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\Homecontroller;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\MagazineController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\MemberRegistrationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\PopupController;
use App\Http\Controllers\PortofolioController;
use App\Http\Controllers\ProductPublicController;
use App\Http\Controllers\RedakturController;
use App\Http\Controllers\RentalCheckController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\SosialMediaController;
use App\Http\Controllers\SubdepController;
use App\Http\Controllers\TestimoniController;
use App\Http\Controllers\TipeController;
use App\Http\Controllers\UserProfileController;
use App\Services\FormBuilder;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [UserProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/upgrade-member', [UserProfileController::class, 'upgradeToMember'])->name('profile.upgrade-member');
    Route::put('/profile/avatar', [UserProfileController::class, 'updateAvatar'])->name('profile.update.avatar');

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart/pending', [CartController::class, 'pending'])->name('cart.pending');
    Route::post('/cart/pending', [CartController::class, 'store_pending'])->name('cart.pending-store');
    Route::post('/cart/pending/store', [CartController::class, 'store_pending'])->name('cart.pending.store');

    Route::get('/cart/process', [CartController::class, 'process'])->name('cart.process');
    Route::get('/cart/done', [CartController::class, 'done'])->name('cart.done');
    Route::post('/review-submit', [CartController::class, 'submitReview'])->name('review.submit');

    // Route::get('/invoice/download/{transaction_code}', [CartController::class, 'downloadInvoice'])->name('invoice.download');
    // Route::post('/cart/add-photo/{photo}', [CartController::class, 'addPhoto'])->name('cart.add.photo');

    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/add-product/{product}', [CartController::class, 'addProduct'])->name('cart.add.product');
    Route::post('/cart/add-photo/{photo}', [CartController::class, 'addPhoto'])->name('cart.add.photo');

    Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    Route::get('/invoice/download/{transaction_code}', [CartController::class, 'downloadInvoice'])->name('invoice.download');
    Route::post('/checkout/multi-store', [CheckoutController::class, 'multiStore'])->name('checkout.multi-store');
    Route::get('/orders', [OrderController::class, 'index'])->name('order.index');

    Route::post('/product-detail', [FrontendController::class, 'product_store'])->name('products.store');
    Route::post('/photos-detail', [FrontendController::class, 'photo_store'])->name('photos.store');

    // Produk checkout
    Route::get('/checkout/product/{id}', [CheckoutController::class, 'form'])->name('checkoutproduct.form');
    Route::post('/checkout/product/{id}', [CheckoutController::class, 'store'])->name('checkout.store');

    // Foto checkout
    Route::get('/checkout/photo/{id}', [CheckoutController::class, 'photoform'])->name('checkoutphoto.form');
    Route::post('/checkout/photo/{id}', [CheckoutController::class, 'storephoto'])->name('checkoutphoto.store');

    Route::get('/checkout/multi/{transaction_id}', [CheckoutController::class, 'multiForm'])->name('checkout.multi-form');
    Route::post('/checkout/multi/{transaction_id}', [CheckoutController::class, 'multiStoreProcess'])->name('checkout.multi-store-process');
    Route::get('/checkout-success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/checkout-success/photo/{id}', [CheckoutController::class, 'successphoto'])->name('checkoutphoto.success');

    // Route::post('/checkout/multi-store', [CheckoutController::class, 'multiStore'])->name('checkout.multi-store');
    // Route::get('/orders', [OrderController::class, 'index'])->name('order.index');
    // Checkout (tampilkan form upload)
    // Route::post('/checkout', [OrderController::class, 'multiStore'])->name('order.multiStore');

    // Simpan transaksi
    Route::post('/transaction/store', [CartController::class, 'store'])->name('transaction.store');

    Route::post('/order/store', [OrderController::class, 'store'])->name('order.store');
    // routes/web.php
    // Route::get('/checkout-success', function () {
    //     return view('frontend.cart.checkout-success');
    // })->name('checkout.success');


    // Route checkout untuk single produk (jika masih diperlukan)
    // Route::post('/product-detail', [FrontendController::class, 'produk_store'])->name('products.store');
    // Single product checkout (existing)
    // Route::get('/checkout/{id}', [CheckoutController::class, 'form'])->name('checkout.form');
    // Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');

    // Multi-store checkout (new)
    // Route::get('/checkout/multi/{transaction_id}', [CheckoutController::class, 'multiForm'])->name('checkout.multi-form');
    // Route::post('/checkout/multi/{transaction_id}', [CheckoutController::class, 'multiStoreProcess'])->name('checkout.multi-store-process');

    // Route::patch('/cart/update-quantity/{id}', [CartController::class, 'updateQuantity'])->name('cart.update-quantity');

    // Success page
    // Route::get('/checkout-success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
});

Route::get('/', [FrontendController::class, 'home'])->name('home');
Route::get('/portofolio-detail/{id}', [FrontendController::class, 'showDetail'])->name('portofolio.detail');
Route::get('/berita-detail/{id}', [FrontendController::class, 'DetailBerita'])->name('detail.berita');

// Route::get('/form', [FormInputController::class, 'public_create'])->name('public.form-input.create');
// Route::post('/form', [FormInputController::class, 'public_store'])->name('public.form-input.store');
// Route::get('/form/{kategori}/fields', [FormInputController::class, 'getFieldsConfig']);
// Route::get('/form/{id}/fields', [FormBuilder::class, 'getFields']);

// Menampilkan semua kategori
Route::get('/form', [FormInputController::class, 'public_index'])->name('public.form-input.index');
// Menampilkan form berdasarkan kategori ID
Route::get('/form/{id}', [FormInputController::class, 'public_create'])->name('public.form-input.create');
// Menyimpan form
Route::post('/form', [FormInputController::class, 'public_store'])->name('public.form-input.store');
// API untuk field dinamis
Route::get('/form/{id}/fields', [FormInputController::class, 'getFields']);

Route::get('/kontak', [FrontendController::class, 'kontak']);
Route::get('/pertanyaan', [FrontendController::class, 'faq']);
Route::get('/logout', [Homecontroller::class, 'logout']);

Route::get('/majalah/{id}', [FrontendController::class, 'show_majalah'])->name('majalah.show');
Route::get('/majalah', [FrontendController::class, 'index_majalah'])->name('majalah.index');
Route::get('/get-magazine-content/{id}', [FrontendController::class, 'getMagazineContent'])->name('majalah.content');
Route::get('/majalah/click/{id}', [FrontendController::class, 'trackMagazineClick'])->name('majalah.track-click');

Route::get('/popup-active', [PopupController::class, 'getActivePopup']);
Route::get('/hubungi-kami', [ContactController::class, 'showForm'])->name('contact.form');
Route::post('/hubungi-kami', [ContactController::class, 'submitForm'])->name('contact.submit');
// Route::resource('form_inputsa', FormInputController::class);
Route::get('/product-detail/{id}', [FrontendController::class, 'produk'])->name('products.detail');
Route::get('/products/track-click/{id}', [FrontendController::class, 'trackProductClick'])->name('products.track-click');


Route::get('/photos-detail/{id}', [FrontendController::class, 'photos'])->name('photos.detail');
Route::get('/acara', [EventController::class, 'indexFrontend']);
Route::get('/acara/{id}', [EventController::class, 'showFrontend'])->name('acara.show');
Route::get('/kontributor', [SosialMediaController::class, 'kontributor']);
Route::get('/redakt', [RedakturController::class, 'redaktur']);
Route::get('/ofcfotografer', [PartnerController::class, 'ofcfotografer']);

// Route::post('/product-detail', [FrontendController::class, 'produk_store'])->name('products.store');
// Route::get('/checkout/{id}', [CheckoutController::class, 'form'])->name('checkout.form');
// Route::post('/checkout/{id}', [CheckoutController::class, 'store'])->name('checkout.store');
// Route::get('/checkout-success/{id}', [CheckoutController::class, 'success'])->name('checkout.success');
Route::get('/auth/{provider}', [SocialiteController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialiteController::class, 'callback']);
// Route::prefix('member')->group(function () {
//     Route::get('/register', [MemberRegistrationController::class, 'showRegistrationForm'])->name('member.register');
//     Route::post('/register', [MemberRegistrationController::class, 'register']);
//     Route::get('/payment/{paymentId}', [MemberRegistrationController::class, 'showPaymentForm'])->name('member.payment');
//     Route::post('/payment/{paymentId}/process', [MemberRegistrationController::class, 'processPayment'])->name('member.payment.process');
// });
Route::get('/member/payment', [MemberController::class, 'payment'])->name('member.payment');
// Route::get('/member/register-payment', [MemberController::class, 'registerPayment'])->name('member.register-payment');
// Route::post('/member/register-payment', [MemberController::class, 'processRegisterPayment'])->name('member.process-register-payment');

Route::get('/member/register-payment', [MemberController::class, 'registerPayment'])
    ->name('member.register-payment');

Route::post('/member/register-payment', [MemberController::class, 'processRegisterPayment'])
    ->name('member.process-register-payment');

Route::get('/buku-tamu', [BukuTamuController::class, 'create'])->name('bukutamu.create');
Route::post('/buku-tamu', [BukuTamuController::class, 'store'])->name('bukutamu.store');

Route::get('/error-403', function () {
    abort(403);
});

Route::get('/error-404', function () {
    abort(404);
});

Route::get('/error-500', function () {
    abort(500);
});
Route::middleware(['auth', 'admin.or.memberopen'])->group(function () {

    // Route::post('/absen', [AttendanceController::class, 'store'])->name('absen.store');

    Route::resource('tamu', BukuTamuController::class);
    Route::resource('absens', AttendanceController::class);
    Route::post('absens/export', [AttendanceController::class, 'export'])->name('absens.export');
    Route::delete('absens/delete-by-date', [AttendanceController::class, 'destroyByDate'])->name('absens.destroyByDate');
    Route::resource('sosmed', SosialMediaController::class);
    Route::resource('redakturs', RedakturController::class);
    Route::resource('partner', PartnerController::class);
    Route::resource('categories_barang', CategoriesBarangContoller::class);
    Route::resource('item', ItemController::class);
    Route::resource('rentals', RentalController::class);
    Route::put('/rentals/{rental}/approve', [RentalController::class, 'approve'])->name('rentals.approve');
    Route::get('/rentals/{rental}/download', [RentalController::class, 'downloadPdf'])->name('rentals.download');
    Route::get('rentals/{rental}/check', [RentalCheckController::class, 'createCheck'])->name('rentals.check.create');
    Route::post('rentals/{rental}/check', [RentalCheckController::class, 'storeCheck'])->name('rentals.check.store');

    // Route untuk melihat hasil pengecekan (bukan show yang nota)
    Route::get('rentals/{rental}/inspection', [RentalCheckController::class, 'showInspection'])->name('rentals.inspection.show');
    // Route::get('/rentals/{rental}', [RentalController::class, 'show'])->name('rentals.show');


    // Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::middleware(['auth', 'role:admin'])->group(function () {
    // Route::get('/admin', [AdminController::class, 'dashboard']);
    // Route::get('/admin', [AdminController::class, 'admin'])->name('admin');
    Route::get('/dashboard', [AdminController::class, 'coba'])->name('coba');
    Route::post('/dashboard/events', [AdminController::class, 'store'])->name('events.store');
    Route::put('/dashboard/events/{id}', [AdminController::class, 'update'])->name('events.update');
    Route::delete('/dashboard/events/{id}', [AdminController::class, 'destroy'])->name('events.destroy');

    Route::post('/withdraw/{user}', [AdminController::class, 'processWithdraw'])
        ->middleware('admin')
        ->name('admin.withdraw');

    Route::resource('faq', FaqController::class);
    Route::resource('video', VideoController::class);

    Route::resource('photo', PhotoController::class);

    Route::resource('subdep', SubdepController::class);

    Route::get('/user', [Homecontroller::class, 'index'])->name('user');
    Route::get('/request', [ContactController::class, 'index'])->name('request');
    Route::get('/users/{user}/edit', [Homecontroller::class, 'edit'])->name('users.edit');
    Route::put('/users/{user}', [Homecontroller::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [Homecontroller::class, 'destroy'])->name('users.destroy');

    Route::resource('members', MemberController::class);
    Route::get('/members/card/{id_member}', [MemberController::class, 'showCard'])->name('members.card');
    Route::get('/members/{id_member}/sertifikat', [MemberController::class, 'sertifikat'])->name('members.sertifikat');
    Route::post('/members/extend', [MemberController::class, 'extend'])->name('members.extend');
    Route::post('/members/{id_member}/approve-extension', [MemberController::class, 'approveExtension'])->name('members.approveExtension');
    Route::get('/members/{id_member}/send-email', [MemberController::class, 'sendEmail'])->name('members.sendEmail');
    Route::post('/members/send-emails-by-date', [MemberController::class, 'sendEmailsByDate'])->name('members.sendEmailsByDate');

    // Route::post('/members-toggle-status/{id_member}', [MemberController::class, 'toggleStatus'])->name('member.toggleStatus');
    Route::post('/members/toggle-status/{id_member}', [MemberController::class, 'toggleStatus'])->name('members.toggleStatus');
    // Route untuk toggle status - PERBAIKAN: ubah ke PATCH dan gunakan nama yang konsisten

    Route::resource('magazine', MagazineController::class);
    Route::resource('magazine', MagazineController::class)->except(['destroy']);
    Route::get('data_majalah', [MagazineController::class, 'data_index'])->name('magazine.data_majalah');
    Route::post('/data_majalah/toggle-status/{id}', [MagazineController::class, 'toggleStatus'])->name('magazine.toggleStatus');
    Route::get('data_majalah/report', [MagazineController::class, 'chart'])->name('magazines.report');
    Route::get('data_majalah/export', [MagazineController::class, 'export'])->name('magazines.export');

    // Jika perlu delete
    // Route::delete('magazine/{magazine}', [MagazineController::class, 'destroy'])
    //     ->name('magazine.destroy');

    Route::resource('kategoris', KategoriController::class);
    Route::post('/kategori/toggle-status/{id}', [KategoriController::class, 'toggleStatus'])->name('kategori.toggleStatus');

    Route::resource('form_inputs', FormInputController::class);
    Route::post('/form-input/{id}/update-status', [FormInputController::class, 'updateStatus'])->name('form-input.update-status');
    Route::put('/form-input/{id}', [FormInputController::class, 'update'])->name('form-input.update');

    Route::resource('/tipe', TipeController::class);

    Route::resource('/porto', PortofolioController::class);
    Route::post('/portofolio/toggle-status/{id}', [PortofolioController::class, 'toggleStatus'])->name('portofolio.toggleStatus');

    Route::resource('/testimoni', TestimoniController::class);
    Route::post('/testimoni/toggle-status/{id}', [TestimoniController::class, 'toggleStatus'])->name('portofolio.toggleStatus');

    Route::resource('/carousel', CarouselController::class);
    Route::post('/carousel/toggle-status/{id}', [CarouselController::class, 'toggleStatus'])->name('portofolio.toggleStatus');

    Route::resource('ebook', EbookController::class);
    Route::resource('ebook-pages', EbookPageController::class);
    Route::get('/ebooks/upload', [EbookUploadController::class, 'create'])->name('ebooks.upload');
    Route::post('/ebooks/upload', [EbookUploadController::class, 'store']);

    Route::resource('categories', CategoryController::class);

    Route::resource('payments', PaymentController::class);
    Route::post('/payments/{id}/update-status', [PaymentController::class, 'updateStatus'])->name('payments.update-status');

    Route::resource('product', ProductController::class);
    Route::get('produk/report', [ProductController::class, 'chart'])->name('product.report');

    Route::resource('popup', PopupController::class);
    Route::post('/admin/popup/{id}/toggle', [PopupController::class, 'toggle'])->name('admin.popup.toggle');

    Route::resource('service', ServiceController::class);

    Route::resource('event', EventController::class);

    Route::resource('berita', BeritaController::class);

    Route::get('/send-expired-notifications', [MemberController::class, 'sendExpiredNotifications']);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/beranda', [FrontendController::class, 'ho']);
    // Route::get('/ho', [FrontendController::class, 'ho'])->name('ho');
});
require __DIR__ . '/auth.php';
