<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WelcomeController;



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

 

Route::get('/', [WelcomeController::class, 'index'])->name('home');



Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Login Route
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// Register Route
Route::get('/register', function () {
    return view('auth.register');
})->name('register');



Route::get('/create', function () {
    return view('admin.users.create');
})->name('create');
Route::get('/edit', function () {
    return view('admin.users.edit');
})->name('edit');

Route::get('/users',[UserController::class,'index'])->name('users');

Route::get('/category', function () {
    return view('admin.category.index');
})->name('category');



Route::get('admin/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
Route::post('admin/users/create', [UserController::class, 'store'])->name('users.store');
Route::get('admin/users/create', [UserController::class, 'create'])->name('users.create');

Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('admin/users/{user}', [UserController::class, 'update'])->name('users.update');
Route::delete('admin/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');


Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
Route::post('/admin/category', [CategoryController::class, 'store'])->name('category.store');
Route::get('/admin/category/{category}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/admin/category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit');
Route::put('/admin/category/{category}', [CategoryController::class, 'update'])->name('category.update');
Route::delete('/admin/category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy');

Route::get('/admin/category', [CategoryController::class, 'index'])->name('admin.category.index');



Route::resource("events", EventController::class, [
    'names' => [
        'index' => 'events'
    ]
]);
// Route::middleware(['auth'])->group(function () {
//     // Index page for events
//     Route::get('/events', [EventController::class, 'index'])->name('events');
    
//     // Show all events
//     Route::get('/events/all', [EventController::class, 'allEvents'])->name('events.all');

//     // Show specific event
//     Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

//     // Create new event
//     Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
//     Route::post('/events', [EventController::class, 'store'])->name('events.store');

//     // Edit event
//     Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
//     Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');

//     // Change event status
//     Route::put('/events/{event}/status', [EventController::class, 'changeStatus'])->name('events.changeStatus');

//     // Delete event
//     Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

//     // Archive events
//     Route::get('/events/archive', [EventController::class, 'archive'])->name('events.archive');
// });

// statistic


Route::get('/admin/allevents', [EventController::class, 'allEvents'])->name('events.all');

// Route for updating event status
Route::put('admin/events/{id}/updateStatus', [EventController::class, 'updateStatus'])->name('events.updateStatus');

// Route for updating reservation status
Route::put('admin/events/{id}/updateStatusreservation', [EventController::class, 'updateStatusreservation'])->name('events.updateStatusreservation');




// Route for searching events by category
Route::get('/searchByCategory', [WelcomeController::class, 'searchByCategory'])->name('searchByCategory');

Route::get('/search', [WelcomeController::class, 'searchByTitle'])->name('searchByTitle');


Route::post('/event/reserve', [EventController::class, 'reservEvent'])->name('reservEvent');


Route::get('accept-reservation', [EventController::class, 'acceptReservation'])->name('acceptReservation');


Route::get('/event/{id}', [WelcomeController::class, 'show'])->name('event.show');


require __DIR__.'/auth.php';
 