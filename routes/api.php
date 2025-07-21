<?php



use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PdfController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// PDF Generation Routes
Route::prefix('pdf')->group(function () {

    // Download generated PDF
    Route::get('download/{filename}', [PdfController::class, 'downloadPdf'])
        ->name('api.pdf.download')
        ->where('filename', '[a-zA-Z0-9._-]+');

    // Get vehicle data preview (for testing)
    Route::get('{id}/preview', [PdfController::class, 'getVehiclePreview'])
        ->name('api.pdf.preview')
        ->where('id', '[0-9]+');
});


// Health check route
Route::get('/health', function () {
    return response()->json([
        'status' => 'ok',
        'timestamp' => now()->toISOString(),
        'service' => 'PDF Generation API',
        'version' => '1.0.0'
    ]);
})->name('api.health');

// Test route
Route::get('/test', function () {
    return response()->json(['message' => 'API is working']);
});