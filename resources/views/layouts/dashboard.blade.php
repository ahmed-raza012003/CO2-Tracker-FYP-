<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Sustainablity Tracker</title>
    <style>
        body {
            transition: background-color 0.3s ease;
            background: linear-gradient(135deg, #e0f7fa, #ffffff);
            font-family: Arial, sans-serif;
        }

        .navbar {
            background-color: #7CB47C; /* Light green background */
            padding: 10px 15px; /* Reduced navbar height */
            position: sticky;
            top: 0; /* Fix the navbar to the top */
            z-index: 1000; /* Ensure it stays above other content */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1); /* Subtle shadow */
        }

        .navbar-brand {
            color: #2e3b2a !important; /* Darker text color */
            font-size: 1.5rem; /* Slightly larger brand font size */
        }

        .nav-link {
            color: #2e3b2a !important; /* Darker text color */
            font-size: 1.2rem; /* Slightly increase font size */
            transition: color 0.3s ease; /* Smooth color transition */
        }

        .nav-link:hover {
            color: #097220 !important; /* Darker green on hover */
        }

        .container {
            margin-top: 20px; /* Add margin for better spacing */
        }

        .btn-danger {
            font-size: 1rem; /* Button size */
            padding: 8px 15px; /* Button padding */
        }

        /* Fade in/out animations */
        .fade-in {
            opacity: 0;
            animation: fadeIn 0.5s forwards;
        }

        @keyframes fadeIn {
            to {
                opacity: 1;
            }
        }

        .fade-out {
            opacity: 0;
            transition: opacity 0.3s ease;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="{{ route('dashboard') }}">Sustainablity Tracker</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Dashboard</a></li>
                @if(auth()->user() && auth()->user()->is_admin)
                    <li class="nav-item"><a class="nav-link" href="{{ route('categories.index') }}">Categories</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('items.index') }}">Items</a></li>
                @endif
                <li class="nav-item"><a class="nav-link" href="{{ route('calculator.form') }}">CO2 Calculator</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('goals.index') }}">Goals</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('reduce.carbon') }}">Tips & Suggestions</a></li>
            </ul>
            
            <form action="{{ route('logout') }}" method="POST" id="logout-form" style="display: none;">
                @csrf
            </form>
            <button type="button" class="btn btn-danger" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Logout
            </button>
        </div>
    </div>
</nav>

<div class="container mt-2">
    @yield('content')
</div>

<script>
    document.querySelectorAll('a').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetUrl = this.getAttribute('href');
            document.body.classList.add('fade-out');
            setTimeout(() => {
                window.location.href = targetUrl;
            }, 300);
        });
    });
</script>

<!-- Toastr CSS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>
</html>
