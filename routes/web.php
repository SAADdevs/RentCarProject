<?php

use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\admin\CarsController;
use App\Http\Controllers\admin\UsersController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\logoutController;
use App\Http\Controllers\costumer\CustomerController;
use App\Http\Controllers\costumer\RentalController;
use App\Http\Controllers\ownerCar\editController;
use App\Http\Controllers\ownerCar\myCarsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\admin\CarController;
use App\Http\Controllers\emailController;
use App\Http\Controllers\ownerCar\RentalRequestController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ownerCar\OwnerController;
use App\Http\Controllers\ownerCar\CreateCarController;
use Illuminate\Support\Facades\Mail;



    Route::get("/", function () {return view("welcome");})->name('home');

    Route::get('/register', [RegisterController::class, 'create'])->name('register');
    Route::post('register', [RegisterController::class, 'store'])->name('register');

    Route::get('/login', [LoginController::class, 'create'])->name('login');
    Route::post('/login', [LoginController::class, 'store'])->name('login');
    
    Route::post('/logout', [logoutController::class,'logout'])->name('logout');

    Route::middleware(['auth', 'can:isAdmin'])->group(function () {
        Route::get('/admin', [AdminController::class,'Index'])->name('admin');
        Route::get('/admin/users', [UsersController::class,'userIndex'])->name('users');
        Route::get('/admin/users/edit/{id}', [UsersController::class,'edit'])->name('editUser');
        Route::put('/admin/users/edit/{id}', [UsersController::class,'updateUser'])->name('updateUser');
        Route::delete('/admin/users/edit/{id}', [UsersController::class,'destroy'])->name('deleteUser');
        Route::get('/admin/cars', [CarController::class, 'Index'])->name('adminCars');
        Route::get('/admin/cars/edit/{id}', [CarController::class, 'edite'])->name('editeUserCar');
        Route::put('/admin/cars/edit/{id}', [CarController::class, 'update'])->name('updateUserCar');
        Route::post('/admin/cars/{id}/approve', [CarController::class, 'approveCar'])->name('CarsAdminAproved');
        Route::post('/admin/cars/{id}/reject', [CarController::class, 'rejectCar'])->name('CarAdminReject');
        Route::delete('/admin/cars/{id}', [CarController::class, 'deleteCar'])->name('CarAdminDelete');
        Route::get('/admin/rentals', [RentalController::class, 'index'])->name('allRetals');
    });

    Route::middleware(['auth', 'can:isOwner'])->group(function () {
        Route::get('/owners', [OwnerController::class,'ownerIndex'])->name('owners');
        Route::get('/owner/CreateCar', [CreateCarController::class, 'index'])->name('CreateCar');
        Route::post('/owner/CreateCar', [CreateCarController::class, 'Create'])->name('CreateCar');
        Route::get('/owner/AllMyCars', [myCarsController::class, 'show'])->name('myCars');
        Route::get('/owner/AllMyRentelCars', [myCarsController::class, 'showCarRentals'])->name('myRentalCars');
        Route::get('/owner/AllMyCars/edit/{id}', [editController::class, 'edite'])->name('editCar');
        Route::put('/owner/AllMyCars/edit/{id}', [editController::class, 'update'])->name('update');
        Route::delete('/owner/AllMyCars/{id}', [editController::class, 'destroy'])->name('deleteCar');
        Route::get('/owner/rental-requests', [RentalRequestController::class, 'showRequests'])->name('rentalRequests');
        Route::post('/owner/rental-requests/approved', [RentalRequestController::class, 'approveRequest'])->name('approveRequest');
        Route::put('/owner/rental-requests/reject/{id}', [RentalRequestController::class, 'rejectRequest'])->name('rejectRequest');
        Route::put('/owner/AllMyRentelCars/complated/{id}', [RentalRequestController::class, 'CompleteRental'])->name('ComplateRental');
        Route::delete('/owner/AllMyRentelCars/cancelled/{id}', [RentalRequestController::class, 'CancelledRental'])->name('CancelledRental');
    });

    Route::middleware(['auth', 'can:isCustomer'])->group(function () {
        Route::get('/costumers', [CustomerController::class,'Index'])->name('costumers');
        Route::post('/costumers/search', [CustomerController::class,'searchCar'])->name('searchingCar');
        Route::get('/costumers/car/{id}', [CustomerController::class, 'viewCarDetails'])->name('viewCarDetails');
        Route::post('/costumer/car/{id}/rent', [CustomerController::class, 'rentCar'])->name('rentCar');
        Route::get('/customer/rentalStatus', [RentalController::class, 'showRentalStatus'])->name('rentalStatus');
        Route::delete('/customers/cancelRental/{id}', [RentalController::class, 'cancelRentals'])->name('cancelRental');
    });

