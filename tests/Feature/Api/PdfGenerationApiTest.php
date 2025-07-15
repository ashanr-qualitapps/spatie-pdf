<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Spatie\LaravelPdf\Facades\Pdf;
use App\Services\VehicleService;
use Illuminate\Support\Facades\Http;
use Mockery;

class PdfGenerationApiTest extends TestCase
{
    /**
     * Test that the PDF endpoint returns a PDF download
     */
    public function test_pdf_generation_endpoint_returns_pdf(): void
    {
        // Mock the Pdf facade
        Pdf::fake();
        
        // Mock the VehicleService
        $this->mock(VehicleService::class, function ($mock) {
            $mock->shouldReceive('getVehicleById')
                ->once()
                ->with('483107')
                ->andReturn(['vehicle' => [
                    'id' => '483107',
                    'fullname' => 'Test Vehicle',
                    'make' => 'Test Make',
                    'model' => 'Test Model',
                    'year' => '2023',
                ]]);
        });
        
        // Make the request
        $response = $this->get('/api/483107/generate-pdf');
        
        // Assert the response
        $response->assertStatus(200);
        
        // Assert that PDF was generated
        Pdf::assertViewIs('pdfs.vehicle');
        Pdf::assertViewHasData('vehicle');
        Pdf::assertViewHasData('id', '483107');
    }
    
    /**
     * Test that the endpoint handles not found vehicles
     */
    public function test_pdf_generation_handles_not_found_vehicle(): void
    {
        // Mock the VehicleService
        $this->mock(VehicleService::class, function ($mock) {
            $mock->shouldReceive('getVehicleById')
                ->once()
                ->with('999999')
                ->andReturn(null);
                
            $mock->shouldReceive('getVehicleFromLocalJson')
                ->once()
                ->andReturn(null);
        });
        
        // Make the request
        $response = $this->get('/api/999999/generate-pdf');
        
        // Assert the response
        $response->assertStatus(404)
            ->assertJson([
                'error' => 'Vehicle data not found',
            ]);
    }
}
