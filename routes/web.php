<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\AcceptedInternController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInternController;
use Illuminate\Support\Facades\Route;

// Public routes (Landing page for intern registration)
Route::get('/', [PublicInternController::class, 'index'])->name('public.landing');
Route::get('/daftar', [PublicInternController::class, 'create'])->name('public.register');
Route::post('/daftar', [PublicInternController::class, 'store'])->name('public.store');
Route::get('/berhasil', [PublicInternController::class, 'success'])->name('public.success');

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

    // HC Routes - Data Apply Magang (sortir & terima), Input ke Unit, Kirim ke Div Head
    Route::middleware(['role:hc,admin'])->group(function () {
        // Export route must be before resource routes
        Route::get('/interns/export', [InternController::class, 'export'])
            ->name('interns.export');

        Route::post('/interns/{id}/status', [InternController::class, 'updateStatus'])
            ->name('interns.updateStatus');

        // Accept intern (create AcceptedIntern entry)
        Route::post('/interns/{id}/accept', [InternController::class, 'acceptIntern'])
            ->name('interns.accept');

        // Mark document as checked
        Route::post('/interns/{id}/document-check', [InternController::class, 'markDocumentChecked'])
            ->name('interns.documentCheck');

        // Send WhatsApp
        Route::get('/interns/{id}/send-whatsapp', [InternController::class, 'sendWhatsApp'])
            ->name('interns.sendWhatsapp');

        Route::resource('interns', InternController::class)->except(['create', 'store']);
    });

    // Accepted Interns routes (HC and Admin only)
    Route::middleware(['role:hc,admin'])->group(function () {
        Route::get('/accepted-interns/export', [AcceptedInternController::class, 'export'])
            ->name('accepted-interns.export');

        Route::get('/accepted-interns/search', [AcceptedInternController::class, 'search'])
            ->name('accepted-interns.search');

        // Send to Div Head for approval
        Route::post('/accepted-interns/{id}/send-to-approval', [AcceptedInternController::class, 'sendToApproval'])
            ->name('accepted-interns.sendToApproval');

        // Generate surat ke kampus
        Route::get('/accepted-interns/{id}/generate-letter', [AcceptedInternController::class, 'generateLetter'])
            ->name('accepted-interns.generateLetter');

        Route::resource('accepted-interns', AcceptedInternController::class);
    });

    // Div Head Routes - Approval from HC
    Route::middleware(['role:div_head,admin'])->group(function () {
        Route::get('/approvals/divhead', [ApprovalController::class, 'divHeadIndex'])
            ->name('approvals.divhead.index');
        Route::post('/approvals/divhead/{id}/approve', [ApprovalController::class, 'divHeadApprove'])
            ->name('approvals.divhead.approve');
        Route::post('/approvals/divhead/{id}/reject', [ApprovalController::class, 'divHeadReject'])
            ->name('approvals.divhead.reject');
    });

    // Deputy Routes - Final Approval
    Route::middleware(['role:deputy,admin'])->group(function () {
        Route::get('/approvals/deputy', [ApprovalController::class, 'deputyIndex'])
            ->name('approvals.deputy.index');
        Route::post('/approvals/deputy/{id}/approve', [ApprovalController::class, 'deputyApprove'])
            ->name('approvals.deputy.approve');
        Route::post('/approvals/deputy/{id}/reject', [ApprovalController::class, 'deputyReject'])
            ->name('approvals.deputy.reject');
    });

    // Show approval detail (all roles that can view)
    Route::middleware(['role:hc,div_head,deputy,admin'])->group(function () {
        Route::get('/approvals/{id}', [ApprovalController::class, 'show'])
            ->name('approvals.show');
    });

    // Database peserta magang yang sudah di-ACC final (semua role bisa lihat)
    Route::middleware(['role:hc,div_head,deputy,admin'])->group(function () {
        Route::get('/database-magang', [AcceptedInternController::class, 'databaseMagang'])
            ->name('database-magang.index');
        Route::get('/database-magang/export', [AcceptedInternController::class, 'exportDatabaseMagang'])
            ->name('database-magang.export');
    });

    // Users management (Admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});
