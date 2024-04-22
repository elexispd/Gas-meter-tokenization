<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\DashboardController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', [PurchaseController::class, 'purchaseToken']);



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/destroy', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/api', [DashboardController::class, 'consumeApi'])->name('api');
    Route::get('/getChartData', [DashboardController::class, 'getChartData'])->name('chart.data');

    Route::prefix('admin')->group(function () {
        Route::get('/', [ProfileController::class, 'admin_index'])->name('admin.index');
        Route::get('/{user}/edit', [ProfileController::class, 'tenant_edit'])->name('admin.edit');
        Route::put('/{user}/edit', [ProfileController::class, 'update'])->name('admin.update');
        Route::get('/admin/create', [ProfileController::class, 'admin_create'])->name('admin.create');
        Route::post('/admin/create', [ProfileController::class, 'admin_store'])->name('admin.store');
        Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('admin.show');
    });

    Route::prefix('user')->group(function () {
        Route::get('/', [ProfileController::class, 'index'])->name('user.index');

        Route::get('/{user}/edit', [ProfileController::class, 'edit'])->name('user.edit');
        Route::put('/{user}/edit', [ProfileController::class, 'update'])->name('user.update');
        Route::get('/create', [ProfileController::class, 'create'])->name('user.add');
        Route::post('/', [ProfileController::class, 'store'])->name('user.store');
    });

    Route::prefix('user/tenant')->group(function () {
        Route::get('/', [ProfileController::class, 'tenant_index'])->name('user.tenant.index');

        Route::get('/{user}/edit', [ProfileController::class, 'tenant_edit'])->name('user.tenant.edit');
        Route::put('/{user}/edit', [ProfileController::class, 'tenant_update'])->name('user.tenant.update');
        Route::get('/create', [ProfileController::class, 'tenant_create'])->name('user.tenant.add');
        Route::post('/', [ProfileController::class, 'tenant_store'])->name('user.tenant.store');
        Route::get('/{user}/plants', [PlantController::class, 'my_plants'])->name('user.tenant.plants');
        Route::get('/{user}/consumers', [PlantController::class, 'my_consumers'])->name('user.tenant.consumers');
        Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('tenant.show');
    });



    Route::get('/profile/change_password', [ProfileController::class, 'change_password'])->name('password.create');
    Route::post('/profile/change_password', [ProfileController::class, 'change_password_store'])->name('password.change');
    Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('user.show');

    Route::prefix('plant')->group(function () {
        Route::get('/', [PlantController::class, 'index'])->name('plant.index');
        Route::get('/create', [PlantController::class, 'create'])->name('plant.add');
        Route::get('/{plant}/edit', [PlantController::class, 'edit'])->name('plant.edit');
        Route::put('/{plant}', [PlantController::class, 'update'])->name('plant.update');
        Route::post('/', [PlantController::class, 'store'])->name('plant.store');
        Route::post('/destroy', [PlantController::class, 'destroy'])->name('plant.destroy');
    });


    Route::prefix('pricing')->group(function () {
        Route::get('/', [PriceController::class, 'index'])->name('price.index');
        Route::get('/create', [PriceController::class, 'create'])->name('price.add');
        Route::post('/create', [PriceController::class, 'store'])->name('price.store');
    });

    Route::prefix('purchase')->group(function () {
        Route::get('/', [PurchaseController::class, 'index'])->name('purchase.index');
        Route::get('/create', [PurchaseController::class, 'create'])->name('purchase.add');
        Route::post('/create', [PurchaseController::class, 'store'])->name('purchase.store');
        Route::get('/send-token', [PurchaseController::class, 'send_token'])->name('purchase.send_token');
        Route::post('/update', [PurchaseController::class, 'update'])->name('purchase.update');
    });


    Route::prefix('payments')->group(function () {
        Route::get('/', [PurchaseController::class, 'search'])->name('payment.search');
        Route::get('/tenant', [PurchaseController::class, 'tenant_search'])->name('payment.tenant.search');
        Route::post('/tenant/result', [PurchaseController::class, 'tenant_search_result'])->name('payment.tenant.result');
        Route::get('/tenant/result', [PurchaseController::class, 'redirectToTenantPaySearch'])->name('payment.t.redirect');
        Route::get('/result', [PurchaseController::class, 'redirectToSearch'])->name('payment.redirect');
        Route::post('/result', [PurchaseController::class, 'search_result'])->name('payment.result');
    });

    Route::prefix('audit')->group(function () {
        Route::get('/', [ActivityController::class, 'search'])->name('audit.search');
        Route::get('/result', [ActivityController::class, 'redirectToSearch'])->name('audit.redirect');
        Route::post('/result', [ActivityController::class, 'search_result'])->name('audit.result');
    });


    Route::get('/status', [PurchaseController::class, 'verifyPayment']);


    Route::get('/paystack-api-key', function () {
        return response()->json(['paystack_api_key' => env('PAYSTACK_API_KEY')]);
    });













});

require __DIR__.'/auth.php';
