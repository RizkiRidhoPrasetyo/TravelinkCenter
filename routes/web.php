<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\TravelinkPackageController;
use App\Models\TravelinkPackage;
use App\Http\Controllers\InteractionController;
use App\Http\Controllers\PackageCommentController;
use App\Http\Controllers\PackageLikeController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Frontend\MemberCardController;
use App\Http\Controllers\Frontend\clubcontroller;
Route::get('/member-card/pdf', [MemberCardController::class, 'pdf'])->middleware('auth')->name('member.card.pdf');


// Booking history route (for authenticated users)
Route::middleware(['auth'])->group(function () {
    Route::get('/booking/history', [BookingController::class, 'history'])->name('booking.history');
});

// Booking routes
Route::get('/booking/{package}', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
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
// home atau index
Route::get('/', function () {
    $topDeals = TravelinkPackage::whereNotNull('promo_price')->take(4)->get();
    $topDestinations = TravelinkPackage::take(4)->get();

    return view('frontend.home', compact('topDeals', 'topDestinations'));
});


Route::get('/travelinkclub', [clubcontroller::class, 'index'])->name('travelinkclub');



// Route autentikasi akan dihandle oleh Laravel Breeze
require __DIR__.'/auth.php';

// Route paket travelink
Route::get('/Paket-travel', [TravelinkPackageController::class, 'index'])->name('packagetravel.index');
Route::post('/packages/{id}/like', [InteractionController::class, 'like'])->name('packages.like');
Route::post('/packages/{id}/comment', [InteractionController::class, 'comment'])->name('packages.comment');
Route::post('/package/{id}/comment', [PackageCommentController::class, 'store'])->name('package.comment');
Route::get('/package/{id}/comments', [PackageCommentController::class, 'list'])->name('package.comments');
Route::get('/travelinkclub/benefits', [TravelinkPackageController::class, 'club'])->name('travelinkclub.benefits');
Route::get('/benefits', function () {
    return view('frontend.club'); // Sesuaikan view jika diperlukan
})->name('benefits');
Route::get('/top-destinations', [TravelinkPackageController::class, 'topDestinations'])->name('top-destinations');

Route::get('/top-deals', [TravelinkPackageController::class, 'topDeals'])->name('top-deals');

Route::get('/lifestyle', function () {
    return view('frontend.lifestyle');
})->name('lifestyle');
Route::post('/package/{id}/like', [PackageLikeController::class, 'toggle'])->name('package.like');
Route::get('/package/{id}/like-count', [PackageLikeController::class, 'count'])->name('package.like.count');
Route::get('/travel/{id}', [\App\Http\Controllers\Frontend\TravelinkPackageController::class, 'show'])->name('travel.single');
