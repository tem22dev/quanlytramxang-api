<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\EntryFormController;
use App\Http\Controllers\Api\V1\FuelController;
use App\Http\Controllers\Api\V1\GasStationController;
use App\Http\Controllers\Api\V1\InvoiceController;
use App\Http\Controllers\Api\V1\StaffController;
use App\Http\Controllers\Api\V1\UploadFileController;
use App\Http\Controllers\Api\V1\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function () {
    Route::post('/login', [AuthController::class, 'login']);

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::get('/user/counter', [UserController::class, 'counterAccount']);
        Route::apiResource('/user', UserController::class);

        Route::get('/gas-station/counter', [GasStationController::class, 'counterGasStation']);
        Route::get('gas-station/search', [GasStationController::class, 'search']);
        Route::apiResource('/gas-station', GasStationController::class);

        Route::get('/staff/counter', [StaffController::class, 'counterStaff']);
        Route::get('/staff/gas-station/{id}', [StaffController::class, 'getListByGasStationId']);
        Route::apiResource('/staff', StaffController::class);

        Route::get('/fuel/counter', [FuelController::class, 'counterFuel']);
        Route::apiResource('/fuel', FuelController::class);

        Route::get('/invoice/counter', [InvoiceController::class, 'counterInvoice']);
        Route::get('/invoice/gas-id/{id}', [InvoiceController::class, 'getListInvoiceByIdGasStation']);
        Route::apiResource('/invoice', InvoiceController::class);
        
        Route::get('/entry-form/counter', [EntryFormController::class, 'counterEntryForm']);
        Route::get('/entry-form/gas-id/{id}', [EntryFormController::class, 'getListEntryFormByIdGasStation']);
        Route::apiResource('/entry-form', EntryFormController::class);

        Route::post('/upload-file', [UploadFileController::class, 'upload']);
        Route::get('/fetch-user', [AuthController::class, 'getUserByToken']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});
