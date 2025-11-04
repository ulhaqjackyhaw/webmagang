<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\AcceptedInternController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Profile routes (All authenticated users)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/change-password', [ProfileController::class, 'editPassword'])->name('profile.edit-password');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.update-password');

    // Interns routes (TU and HC can access)
    Route::middleware(['role:tu,hc,admin'])->group(function () {
        // Export route must be before resource routes
        Route::get('/interns/export', [InternController::class, 'export'])
            ->name('interns.export')
            ->middleware('role:hc,admin');

        Route::post('/interns/{id}/status', [InternController::class, 'updateStatus'])
            ->name('interns.updateStatus')
            ->middleware('role:hc,admin');

        Route::resource('interns', InternController::class);
    });

    // Accepted Interns routes (HC and Admin only)
    Route::middleware(['role:hc,admin'])->group(function () {
        Route::get('/accepted-interns/export', [AcceptedInternController::class, 'export'])
            ->name('accepted-interns.export');

        Route::get('/accepted-interns/search', [AcceptedInternController::class, 'search'])
            ->name('accepted-interns.search');

        Route::resource('accepted-interns', AcceptedInternController::class);
    });

    // Users management (Admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});
