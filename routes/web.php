<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternController;
use App\Http\Controllers\AcceptedInternController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicInternController;
use App\Http\Controllers\PeriodeMagangController;
use App\Http\Controllers\AdministrasiPersuratanController;
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

        // Periode Magang Management
        Route::patch('/periode-magang/{id}/toggle-status', [PeriodeMagangController::class, 'toggleStatus'])
            ->name('periode-magang.toggle-status');
        Route::resource('periode-magang', PeriodeMagangController::class);
    });

    // Accepted Interns routes (HC and Admin only)
    Route::middleware(['role:hc,admin'])->group(function () {
        Route::get('/accepted-interns/export', [AcceptedInternController::class, 'export'])
            ->name('accepted-interns.export');

        Route::get('/accepted-interns/search', [AcceptedInternController::class, 'search'])
            ->name('accepted-interns.search');

        // Verify documents and send to Div Head
        Route::post('/accepted-interns/{id}/verify-and-send', [AcceptedInternController::class, 'verifyDocumentsAndSend'])
            ->name('accepted-interns.verifyAndSend');

        // Send to Div Head for approval
        Route::post('/accepted-interns/{id}/send-to-approval', [AcceptedInternController::class, 'sendToApproval'])
            ->name('accepted-interns.sendToApproval');

        // Reject by HC
        Route::post('/accepted-interns/{id}/reject-by-hc', [AcceptedInternController::class, 'rejectByHC'])
            ->name('accepted-interns.rejectByHC');

        // Bulk delete
        Route::delete('/accepted-interns/bulk-delete', [AcceptedInternController::class, 'bulkDelete'])
            ->name('accepted-interns.bulkDelete');

        // Bulk forward to Div Head
        Route::post('/accepted-interns/bulk-forward-to-divhead', [AcceptedInternController::class, 'bulkForwardToDivHead'])
            ->name('accepted-interns.bulkForwardToDivHead');

        // Mark document as viewed (AJAX)
        Route::post('/accepted-interns/{id}/mark-document-viewed', [AcceptedInternController::class, 'markDocumentViewed'])
            ->name('accepted-interns.markDocumentViewed');

        // Generate surat ke kampus
        Route::get('/accepted-interns/{id}/generate-letter', [AcceptedInternController::class, 'generateLetter'])
            ->name('accepted-interns.generateLetter');

        // Mark rejection WhatsApp as sent
        Route::post('/accepted-interns/{id}/mark-rejection-wa-sent', [AcceptedInternController::class, 'markRejectionWaSent'])
            ->name('accepted-interns.markRejectionWaSent');

        Route::resource('accepted-interns', AcceptedInternController::class);

        // Administrasi Persuratan routes
        Route::get('/administrasi-persuratan', [AdministrasiPersuratanController::class, 'index'])
            ->name('administrasi-persuratan.index');
        Route::get('/administrasi-persuratan/{id}/download-surat-konfirmasi', [AdministrasiPersuratanController::class, 'downloadSuratKonfirmasiUnit'])
            ->name('administrasi-persuratan.download-surat-konfirmasi');
        Route::get('/administrasi-persuratan/{id}/download-surat-kampus', [AdministrasiPersuratanController::class, 'downloadSuratKeKampus'])
            ->name('administrasi-persuratan.download-surat-kampus');
        Route::get('/administrasi-persuratan/{id}/send-whatsapp', [AdministrasiPersuratanController::class, 'sendWhatsAppOnboarding'])
            ->name('administrasi-persuratan.send-whatsapp');
        Route::post('/administrasi-persuratan/bulk-download-konfirmasi', [AdministrasiPersuratanController::class, 'bulkDownloadSuratKonfirmasi'])
            ->name('administrasi-persuratan.bulk-download-konfirmasi');
        Route::post('/administrasi-persuratan/bulk-download-kampus', [AdministrasiPersuratanController::class, 'bulkDownloadSuratKampus'])
            ->name('administrasi-persuratan.bulk-download-kampus');
        Route::post('/administrasi-persuratan/bulk-send-whatsapp', [AdministrasiPersuratanController::class, 'bulkSendWhatsApp'])
            ->name('administrasi-persuratan.bulk-send-whatsapp');
    });

    // Div Head Routes - Approval from HC
    Route::middleware(['role:div_head,admin'])->group(function () {
        Route::get('/approvals/divhead', [ApprovalController::class, 'divHeadIndex'])
            ->name('approvals.divhead.index');
        Route::post('/approvals/divhead/{id}/approve', [ApprovalController::class, 'divHeadApprove'])
            ->name('approvals.divhead.approve');
        Route::post('/approvals/divhead/{id}/reject', [ApprovalController::class, 'divHeadReject'])
            ->name('approvals.divhead.reject');
        Route::post('/approvals/divhead/bulk-approve', [ApprovalController::class, 'bulkDivHeadApprove'])
            ->name('approvals.divhead.bulkApprove');
        Route::post('/approvals/divhead/bulk-reject', [ApprovalController::class, 'bulkDivHeadReject'])
            ->name('approvals.divhead.bulkReject');
    });

    // Deputy Routes - Final Approval
    Route::middleware(['role:deputy,admin'])->group(function () {
        Route::get('/approvals/deputy', [ApprovalController::class, 'deputyIndex'])
            ->name('approvals.deputy.index');
        Route::post('/approvals/deputy/{id}/approve', [ApprovalController::class, 'deputyApprove'])
            ->name('approvals.deputy.approve');
        Route::post('/approvals/deputy/{id}/reject', [ApprovalController::class, 'deputyReject'])
            ->name('approvals.deputy.reject');
        Route::post('/approvals/deputy/bulk-approve', [ApprovalController::class, 'bulkDeputyApprove'])
            ->name('approvals.deputy.bulkApprove');
        Route::post('/approvals/deputy/bulk-reject', [ApprovalController::class, 'bulkDeputyReject'])
            ->name('approvals.deputy.bulkReject');
    });

    // Show approval detail (all roles that can view)
    Route::middleware(['role:hc,div_head,deputy,admin'])->group(function () {
        Route::get('/approvals/{id}', [ApprovalController::class, 'show'])
            ->name('approvals.show');
    });

    // Database peserta magang yang sudah di-ACC final
    // Only HC and Admin can export/edit/delete
    Route::middleware(['role:hc,admin'])->group(function () {
        Route::get('/database-magang/export', [AcceptedInternController::class, 'exportDatabaseMagang'])
            ->name('database-magang.export');
        Route::post('/database-magang/bulk-wa-surat-kampus', [AcceptedInternController::class, 'bulkSendWaSuratKampus'])
            ->name('database-magang.bulk-wa-surat-kampus');
        Route::get('/database-magang/{id}/edit', [AcceptedInternController::class, 'editDatabaseMagang'])
            ->name('database-magang.edit');
        Route::put('/database-magang/{id}', [AcceptedInternController::class, 'updateDatabaseMagang'])
            ->name('database-magang.update');
        Route::delete('/database-magang/{id}', [AcceptedInternController::class, 'destroyDatabaseMagang'])
            ->name('database-magang.destroy');
    });

    // All roles can view
    Route::middleware(['role:hc,div_head,deputy,admin'])->group(function () {
        Route::get('/database-magang', [AcceptedInternController::class, 'databaseMagang'])
            ->name('database-magang.index');
        Route::get('/database-magang/{id}', [AcceptedInternController::class, 'showDatabaseMagang'])
            ->name('database-magang.show');
    });

    // Users management (Admin only)
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });
});
