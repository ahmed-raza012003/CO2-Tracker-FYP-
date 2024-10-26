@extends('layouts.app')

@section('content')
<!-- Welcome Section -->
<section id="welcome" class="text-center text-white position-relative" style="background-image: url('/images/welcome-bg.jpg'); background-size: cover; background-position: center; padding: 140px 0;">
    <div class="overlay"></div>
    <div class="container position-relative z-2">
        <h1 class="display-3 fw-bold animate__animated animate__fadeInDown">Welcome to <span class="text-warning">Sustainablity Tracker
</span></h1>
        <p class="lead mt-3 mb-5 animate__animated animate__fadeInUp">Empowering you to reduce your carbon footprint with real-time insights and actionable suggestions.</p>
        <div class="mt-4">
            <a href="{{ route('login') }}" class="btn btn-success btn-lg shadow-lg me-3 rounded-pill px-5">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg shadow-lg rounded-pill px-5">Get Started</a>
        </div>
    </div>
</section>

<!-- Introduction Section -->
<section id="intro" class="py-5 text-white" style="background: linear-gradient(135deg, #A8E6CE, #34c759);">
    <div class="container text-center">
        <h2 class="fw-bold mb-4">Track, Analyze & Improve Your Carbon Footprint</h2>
        <p class="mb-5">Our platform offers real-time tracking and personalized suggestions to help you minimize your carbon footprint and make sustainable lifestyle choices.</p>
        <div class="row g-4 justify-content-center">
            <div class="col-md-8">
                <img src="/images/dashboard.png" alt="Tracking Your Carbon Footprint" class="img-fluid rounded-lg shadow-lg mb-4">
                <p class="lead">With Sustainablity Tracker
, you can easily track your daily performance, set personal goals, visualize your progress with graphs, and calculate your overall consumption. Join us on the journey toward sustainability!</p>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5" style="background-color: #f0f4f1;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="/images/about-us.jpg" alt="About Us" class="img-fluid rounded-lg shadow-lg">
            </div>
            <div class="col-md-6">
                <h3 class="text-success fw-bold">About Us</h3>
                <p class="mt-3">At Sustainablity Tracker
, we are passionate about environmental sustainability. Our goal is to empower individuals and businesses to track and minimize their carbon footprint with ease. With advanced tracking tools and expert advice, we help you make informed decisions that positively impact the planet.</p>
                <a href="#contact" class="btn btn-success mt-4 px-4 py-2 rounded-pill shadow">Learn More</a>
            </div>
        </div>
    </div>
</section>

<!-- Why You Should Register Section -->
<section id="why-register" class="py-5" style="background-color: #e8f5e9;">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0 text-center">
                <img src="/images/benifits.jpg" alt="Benefits of Sustainablity Tracker
" class="img-fluid rounded-lg shadow-lg" style="max-width: 80%; height: auto;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-bold mb-4 text-success">Why You Should Register</h2>
                <p class="lead mb-4">Joining Sustainablity Tracker
 gives you the tools to take control of your carbon footprint. Here’s what you can do:</p>
                <ul class="list-unstyled mb-4">
                    <li class="mb-3"><i class="bi bi-check-circle text-success"></i> <strong>Track Your Daily Performance:</strong> Monitor your carbon emissions in real-time.</li>
                    <li class="mb-3"><i class="bi bi-check-circle text-success"></i> <strong>Set and Achieve Goals:</strong> Establish targets to reduce your CO2 output.</li>
                    <li class="mb-3"><i class="bi bi-check-circle text-success"></i> <strong>Visualize Progress with Graphs:</strong> Get detailed insights through interactive graphs.</li>
                    <li class="mb-3"><i class="bi bi-check-circle text-success"></i> <strong>Calculate Your Consumption:</strong> Understand the impact of your daily choices.</li>
                </ul>
                <a href="{{ route('register') }}" class="btn btn-success rounded-pill px-4 shadow">Get Started</a>
            </div>
        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="py-5 bg-success text-white" >
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="text-warning fw-bold">Get In Touch</h2>
            <p class="lead">Have any questions or suggestions? We’re here to help!</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <form>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Your Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="name@example.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Your message" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning shadow rounded-pill px-4 py-2">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
