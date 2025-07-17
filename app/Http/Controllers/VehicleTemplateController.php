<?php

namespace App\Http\Controllers;

use App\Services\VehicleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Fluent;

class VehicleTemplateController extends Controller
{
    protected $vehicleService;

    public function __construct(VehicleService $vehicleService)
    {
        $this->vehicleService = $vehicleService;
    }

    /**
     * Display the vehicle information view
     */
    public function show(Request $request, $vehicleId = null)
    {
        try {
            // Get vehicle ID from route parameter or request query parameter
            $vehicleId = $vehicleId ?? $request->query('id', '483107'); // Default ID if not provided
            
            Log::info("Attempting to fetch vehicle data for ID: {$vehicleId}");

            // Try fetching from API
            $vehicle = $this->fetchVehicleData($vehicleId);

            if (!$vehicle) {
                Log::warning("Vehicle data not found for ID: {$vehicleId}");
                return response()->view('errors.404', ['message' => "Vehicle with ID {$vehicleId} not found"], 404);
            }

            Log::info("Successfully fetched vehicle data for ID: {$vehicleId}");
            return view('pdftemp.vehicle-invoice', [
                'vehicle' => $this->transformVehicleData($vehicle),
            ]);
        } catch (\Exception $e) {
            Log::error('Error loading vehicle data: ' . $e->getMessage(), [
                'vehicleId' => $vehicleId,
                'trace' => $e->getTraceAsString()
            ]);
            return response()->view('errors.500', [], 500);
        }
    }

    /**
     * Fetch vehicle data from API or local JSON, return as object
     */
    private function fetchVehicleData($vehicleId)
    {
        $vehicle = $this->vehicleService->getVehicleById($vehicleId);

        if (!$vehicle) {
            $vehicle = $this->vehicleService->getVehicleFromLocalJson();
        }

        // Return as object for non-text data support
        return $vehicle ? (object) $vehicle : null;
    }

    /**
     * Transform and normalize vehicle data to match template expectations
     * Returns an object for compatibility with non-text data
     */
    private function transformVehicleData($data)
    {
        // Use Fluent for object-like access and flexibility
        return new Fluent([
            // Basic Information
            'vsbWip' => $data->vsbWip ?? $data->id ?? 'N/A',
            'make' => $data->make ?? 'N/A',
            'model' => $data->model ?? 'N/A',
            'version' => $data->version ?? 'N/A',
            'year' => $data->year ?? 'N/A',
            'kilometers' => $data->kilometers ?? 0,
            'price' => $data->price ?? 0,

            // Technical Specifications
            'fuel' => $data->fuel ?? 'N/A',
            'transmission' => $data->transmission ?? 'N/A',
            'driveTrain' => $data->driveTrain ?? 'N/A',
            'power' => $data->power ?? 'N/A',
            'powerCV' => $data->powerCV ?? 'N/A',
            'seats' => $data->seats ?? 'N/A',
            'doors' => $data->doors ?? 'N/A',
            'color' => $data->color ?? 'N/A',
            'environmentalLabel' => $data->environmentalLabel ?? 'N/A',
            'warranty' => $data->warranty ?? 'N/A',

            // Dimensions
            'height' => $data->height ?? 'N/A',
            'length' => $data->length ?? 'N/A',
            'width' => $data->width ?? 'N/A',
            'maximumSpeed' => $data->maximumSpeed ?? 'N/A',
            'consumption' => $data->consumption ?? 'N/A',
            'engineCapacity' => $data->engineCapacity ?? 'N/A',

            // Categories and Types
            'type' => [
                'name' => $data->type->name ?? $data->type ?? 'N/A'
            ],
            'category' => [
                'name' => $data->category->name ?? $data->category ?? 'N/A'
            ],

            // Financial Information
            'financialInformation' => [
                'financedPrice' => $data->financialInformation->financedPrice ?? $data->financedPrice ?? 0,
                'monthlyPayment' => $data->financialInformation->monthlyPayment ?? $data->monthlyPayment ?? 0,
            ],

            // Descriptions
            'description' => $data->description ?? 'No hay descripción disponible para este vehículo.',
            'description2' => $data->description2 ?? 'No hay datos adicionales disponibles.',

            // Images
            'imageUrl' => $data->imageUrl ?? ($data->images[0] ?? asset('images/no-vehicle-image.jpg')),
            'images' => $data->images ?? [],
        ]);
    }

    /**
     * Get vehicle data as JSON (API endpoint)
     */
    public function getVehicleJson($vehicleId)
    {
        try {
            $vehicle = $this->fetchVehicleData($vehicleId);

            if (!$vehicle) {
                return response()->json(['error' => 'Vehicle not found'], 404);
            }

            return response()->json([
                'success' => true,
                'data' => $vehicle
            ]);
        } catch (\Exception $e) {
            Log::error('Error getting vehicle JSON: ' . $e->getMessage());
            return response()->json(['error' => 'Internal server error'], 500);
        }
    }
}
