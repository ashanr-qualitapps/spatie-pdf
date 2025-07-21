@extends('pdfs.layouts.master')

@section('title', 'Vehicle Information: ' . ($vehicle['make'] ?? '') . ' ' . ($vehicle['model'] ?? ''))

@section('styles')
    <style>
        .vehicle-image {
            text-align: center;
            margin: 20px 0;
        }
        
        .vehicle-image img {
            max-width: 100%;
            max-height: 300px;
            border-radius: 5px;
        }
        
        .specifications {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px;
        }
        
        .spec-item {
            width: 50%;
            padding: 0 10px;
            box-sizing: border-box;
            margin-bottom: 10px;
        }
        
        .price-section {
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            padding: 15px;
            border-radius: 5px;
            margin: 20px 0;
        }
        
        .price {
            font-size: 24px;
            color: #2c3e50;
            font-weight: bold;
        }
        
        .equipment-list {
            columns: 2;
            column-gap: 20px;
        }
        
        .equipment-list li {
            margin-bottom: 5px;
            break-inside: avoid;
        }
    </style>
@endsection

@section('content')
    <div class="content-section">
        <h2 class="section-title">Vehicle Overview</h2>
        <p><strong>{{ $vehicle['fullname'] ?? $vehicle['make'] . ' ' . $vehicle['model'] }}</strong></p>
        
        @if(!empty($vehicle['imageUrl']))
            <div class="vehicle-image">
                <img src="{{ $vehicle['imageUrl'] }}" alt="Vehicle Image">
            </div>
        @elseif(!empty($vehicle['images']) && count($vehicle['images']) > 0)
            <div class="vehicle-image">
                <img src="{{ $vehicle['images'][0] }}" alt="Vehicle Image">
            </div>
        @endif
    </div>
    
    <div class="content-section">
        <h2 class="section-title">Vehicle Details</h2>
        <table>
            <tr>
                <th>Make</th>
                <td>{{ $vehicle['make'] ?? 'N/A' }}</td>
                <th>Model</th>
                <td>{{ $vehicle['model'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Year</th>
                <td>{{ $vehicle['year'] ?? 'N/A' }}</td>
                <th>Color</th>
                <td>{{ $vehicle['color'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Registration</th>
                <td>{{ $vehicle['registrationPlate'] ?? 'N/A' }}</td>
                <th>VIN/Chassis</th>
                <td>{{ $vehicle['chassisNumber'] ?? $vehicle['vin'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Kilometers</th>
                <td>{{ $vehicle['kilometers'] ?? 'N/A' }}</td>
                <th>Fuel Type</th>
                <td>{{ $vehicle['fuel'] ?? 'N/A' }}</td>
            </tr>
            <tr>
                <th>Transmission</th>
                <td>{{ $vehicle['transmission'] ?? 'N/A' }}</td>
                <th>Drive Train</th>
                <td>{{ $vehicle['driveTrain'] ?? 'N/A' }}</td>
            </tr>
        </table>
    </div>
    
    @if(!empty($vehicle['price']) || !empty($vehicle['financedPrice']))
        <div class="content-section price-section">
            <h2 class="section-title">Pricing Information</h2>
            @if(!empty($vehicle['price']))
                <p><strong>List Price:</strong> <span class="price">{{ $vehicle['price'] }} €</span></p>
            @endif
            
            @if(!empty($vehicle['financedPrice']))
                <p><strong>Financed Price:</strong> {{ $vehicle['financedPrice'] }} €</p>
            @endif
            
            @if(!empty($vehicle['financialInformation']['monthlyPayment']))
                <p><strong>Monthly Payment:</strong> {{ $vehicle['financialInformation']['monthlyPayment'] }} €</p>
            @endif
        </div>
    @endif
    
    @if(!empty($vehicle['description']))
        <div class="content-section">
            <h2 class="section-title">Description</h2>
            <div>{!! $vehicle['description'] !!}</div>
        </div>
    @endif
    
    @if(!empty($vehicle['equipment']) && count($vehicle['equipment']) > 0)
        <div class="content-section">
            <h2 class="section-title">Equipment & Features</h2>
            <ul class="equipment-list">
                @foreach($vehicle['equipment'] as $item)
                    <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@endsection
