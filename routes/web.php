<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VaccinationRecordController;
use App\Http\Controllers\VaccinationReportController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\DailyUsageController;
use App\Http\Controllers\WarningController;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

Route::get('/api/admin', [AdminController::class, 'getAllAdmins']);

Route::get('/api/announcement', [AnnouncementController::class, 'getAllAnnouncements']);
Route::get('/api/announcement/{id}', [AnnouncementController::class, 'getAnnouncementById']);
Route::post('/api/announcement', [AnnouncementController::class, 'createAnnouncement']);
Route::put('/api/announcement/{id}', [AnnouncementController::class, 'updateAnnouncement']);
Route::delete('/api/announcement/{id}', [AnnouncementController::class, 'deleteAnnouncement']);

Route::get('/api/user', [UserController::class, 'index']);
Route::get('/api/user/{id}', [UserController::class, 'show']);
Route::post('/api/user', [UserController::class, 'store']);
Route::put('/api/user/{id}', [UserController::class, 'update']);
Route::delete('/api/user/{id}', [UserController::class, 'destroy']);
Route::post('/api/login', [UserController::class, 'login']);

Route::get('/api/record', [VaccinationRecordController::class, 'index']);
Route::get('/api/record/{id}', [VaccinationRecordController::class, 'show']);
Route::post('/api/record', [VaccinationRecordController::class, 'store']);
Route::put('/api/record/{id}', [VaccinationRecordController::class, 'update']);
Route::put('/api/categ/{id}', [VaccinationRecordController::class, 'updateExpcateg']);
Route::put('/api/queue/{id}', [VaccinationRecordController::class, 'updateStatus']);
Route::put('/api/return/{id}', [VaccinationRecordController::class, 'returnStatus']);
Route::put('/api/old/{id}', [VaccinationRecordController::class, 'oldStatus']);
Route::put('/api/boost/{id}', [VaccinationRecordController::class, 'boostStatus']);
Route::delete('/api/record/{id}', [VaccinationRecordController::class, 'destroy']);

Route::get('/vaccination-report', [VaccinationReportController::class, 'getYearlyVaccinationReport']);
Route::get('/vaccination-report/filtered', [VaccinationReportController::class, 'getFilteredRecords']);

// INVENTORY
Route::get('/inventory', [InventoryController::class, 'index']);
Route::get('/inventory/{vaccine_id}', [InventoryController::class, 'show']);
Route::post('/inventory', [InventoryController::class, 'store']);
Route::put('/inventory/{vaccine_id}', [InventoryController::class, 'update']);
Route::put('/inventory/use/{vaccine_id}', [InventoryController::class, 'useStock']);
Route::post('/inventory/decrease/{vaccine_id}', [InventoryController::class, 'decreaseStock']);

Route::get('/usage', [DailyUsageController::class, 'index']);
Route::get('/usage/{id}', [DailyUsageController::class, 'show']);

Route::get('/warning', [WarningController::class, 'index']);
Route::get('/warning/{id}', [WarningController::class, 'show']);
Route::put('/warning/{id}', [WarningController::class, 'update']);

// Email verification routes
Route::get('email/verify', function () {
    return response()->json(['message' => 'Please verify your email.']); // No view, just a message
})->name('verification.notice');

Route::get('email/verify/{id}/{hash}', function ($id, $hash) {
    // Fetch the user by ID
    $user = \App\Models\User::findOrFail($id);

    // Check if the hash matches
    if (!hash_equals(sha1($user->getEmailForVerification()), $hash)) {
        return response()->json(['message' => 'Invalid or expired verification link.'], 400);
    }

    // Mark the email as verified if not already
    if (!$user->hasVerifiedEmail()) {
        $user->markEmailAsVerified();
    }

     // Redirect to login page
    return redirect('http://localhost:8081/login?emailVerified=true');
})->middleware(['signed'])->name('verification.verify');

// Resend email verification notification
Route::post('email/verification-notification', function () {
    request()->user()->sendEmailVerificationNotification();
    return response()->json(['message' => 'Verification link sent!']);
})->name('verification.resend');