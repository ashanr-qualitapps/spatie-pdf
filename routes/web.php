<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\VehicleTemplateController;
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

Route::resource('invoices', InvoiceController::class);
Route::get('invoices/{invoice}/download-pdf', [InvoiceController::class, 'downloadPdf'])->name('invoices.download-pdf');
Route::get('invoices/{invoice}/view-pdf', [InvoiceController::class, 'viewPdf'])->name('invoices.view-pdf');
Route::get('/invoices/download-all-pdf', [InvoiceController::class, 'downloadAllPdf'])->name('invoices.download-all-pdf');

// Updated routes for vehicle template viewing
Route::get('view/template', [VehicleTemplateController::class, 'show'])->name('pdf.template.view'); // Uses default vehicle ID
Route::get('view/template/{vehicleId}', [VehicleTemplateController::class, 'show'])->name('pdf.template.view.with.id');
Route::get('/vehicle/{vehicleId}', [VehicleTemplateController::class, 'show'])->name('vehicle.show');