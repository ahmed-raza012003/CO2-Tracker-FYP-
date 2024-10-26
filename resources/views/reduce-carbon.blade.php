@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <!-- Introduction Section -->
    <section class="text-center mb-5">
        <h1 class="display-4 text-success">Reduce Your Carbon Footprint</h1>
        <p class="lead text-success">Explore steps to reduce carbon emissions and support environmental health.</p>
    </section>

    <!-- Tips Section -->
    <section class="mb-5">
        <h2 class="text-success">Tips to Cut Carbon Consumption</h2>
        <div class="row">
            <!-- Energy Efficiency Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">
                        <h5>Optimize Energy Use</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Switch to LED lighting and energy-efficient appliances.</li>
                            <li>Insulate your home to save on heating and cooling.</li>
                            <li>Install a smart thermostat to manage energy usage.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Sustainable Transportation Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">
                        <h5>Sustainable Transportation</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Choose public transportation, biking, or walking when possible.</li>
                            <li>Opt for fuel-efficient or electric vehicles.</li>
                            <li>Combine errands to reduce driving time.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- More Cards for Additional Tips -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">
                        <h5>Water Conservation</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Use water-saving devices and fixtures.</li>
                            <li>Fix any leaks immediately to avoid wastage.</li>
                            <li>Opt for shorter showers to reduce hot water usage.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">
                        <h5>Adopt Renewable Energy</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled">
                            <li>Consider installing solar panels if feasible.</li>
                            <li>Choose a green energy provider.</li>
                            <li>Use renewable sources for heating and cooling.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Suggestions Section -->
    <section class="mb-5">
        <h2 class="text-success">Additional Suggestions</h2>
        <div class="row">
            <!-- Suggestion Card 1 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">Green Energy</div>
                    <div class="card-body">
                        <p class="text-muted">Choose renewable energy sources like solar or wind if available.</p>
                    </div>
                </div>
            </div>
            <!-- Suggestion Card 2 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">Educate & Inspire</div>
                    <div class="card-body">
                        <p class="text-muted">Share knowledge about sustainability practices with others.</p>
                    </div>
                </div>
            </div>
            
            <!-- Suggestion Card 3 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">Community Initiatives</div>
                    <div class="card-body">
                        <p class="text-muted">Participate in or support local environmental programs.</p>
                    </div>
                </div>
            </div> 
            <!-- Suggestion Card 4 -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="card-header bg-success text-white">Home Upgrades</div>
                    <div class="card-body">
                        <p class="text-muted">Invest in energy-efficient home improvements, like insulation.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Health Impact Section -->
    <section class="mb-5">
        <h2 class="text-success text-center mb-4">Health Impacts of CO2</h2>
        <div class="row">
            <!-- Lungs Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-6">
                            <img src="{{ asset('images/lungs.jpg') }}" alt="Lungs illustration" class="img-fluid p-3" style="width: 100%; height: 200px;">
                        </div>
                        <div class="col-md-6 p-3">
                            <h5 class="text-success">Lungs</h5>
                            <p class="text-muted">CO2 buildup can lead to respiratory issues, affecting breathing and oxygen intake.</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Heart Card -->
            <div class="col-md-6 mb-4">
                <div class="card shadow-lg border-0 rounded-lg card-hover" style="background-color: #C4E4C1;">
                    <div class="row g-0 align-items-center">
                        <div class="col-md-6">
                            <img src="{{ asset('images/heart.jpg') }}" alt="Heart illustration" class="img-fluid p-3" style="width: 100%; height: 200px;">
                        </div>
                        <div class="col-md-6 p-3">
                            <h5 class="text-success">Heart</h5>
                            <p class="text-muted">High CO2 levels can strain the heart, leading to cardiovascular issues.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Call to Action Section -->
    <section class="text-center mb-5">
        <h2 class="text-success">Take Action Now!</h2>
        <p class="text-muted">Start implementing these steps today to make a meaningful impact on the environment.</p>
        <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg animate__animated animate__pulse animate__infinite">Back to Dashboard</a>
    </section>
</div>

<!-- Custom CSS -->
<style>
    .container { max-width: 1100px; }
    .display-4 { font-weight: 700; color: #28a745; }
    .card-header { font-size: 1.25rem; }
    .list-unstyled li { margin-bottom: 0.75rem; font-size: 1rem; }
    .text-muted { color: #6c757d !important; }
    .btn-success { background-color: #28a745; border-color: #28a745; }
    .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
    
    /* Card Hover Effect */
    .card-hover:hover {
        transform: translateY(-10px);
        transition: transform 0.3s ease;
        box-shadow: 0px 4px 15px rgba(0, 128, 0, 0.3);
    }
</style>
@endsection
