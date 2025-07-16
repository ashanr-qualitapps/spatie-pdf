<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VehicleService
{
    /**
     * Fetch vehicle data from the API
     *
     * @param string|int $id
     * @return array|null
     */
    public function getVehicleById($id)
    {
        try {
            $baseUrl = config('services.vehicle_api.url') ?? env('DATA_API_URL');
            $baseUrl = rtrim($baseUrl, '/');
            // Only append the ID if not already present
            $url = "{$baseUrl}/{$id}";
            
            Log::info("Fetching vehicle data from: {$url}");
            
            // Make the API request
            $response = Http::get($url);
            
            if ($response->successful()) {
                return $response->json();
            } else {
                Log::error("API request failed for vehicle ID {$id}: " . $response->status());
                return null;
            }
        } catch (\Exception $e) {
            Log::error("Error fetching vehicle data: " . $e->getMessage());
            return null;
        }
    }
    
    /**
     * Fetch vehicle data from local JSON file (for testing/fallback)
     *
     * @return array|null
     */
    public function getVehicleFromLocalJson()
    {
        try {
            $path = storage_path('app/apidata.json');
            if (!file_exists($path)) {
                $path = base_path('apidata.json');
            }
            
            if (file_exists($path)) {
                $jsonContent = file_get_contents($path);
                return json_decode($jsonContent, true);
            }
            
            return null;
        } catch (\Exception $e) {
            Log::error("Error reading local JSON: " . $e->getMessage());
            return null;
        }
    }
}
