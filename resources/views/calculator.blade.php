@extends('layouts.dashboard')

@section('content')
<div class="container py-5">
    <h1 class="text-center text-success display-4 mb-5 animate__animated animate__fadeInDown">🌍 CO2 Calculator</h1>

    @if (session('result'))
        <div class="alert alert-{{ session('result.color') }} mb-4 fade-in">
            {{ session('result.message') }}
            @if (session('result.difference') !== null)
                <div class="mt-2">
                    @if (session('result.difference') > 0)
                        <strong>Increased by:</strong> {{ session('result.difference') }} g CO2
                    @elseif (session('result.difference') < 0)
                        <strong>Reduced by:</strong> {{ abs(session('result.difference')) }} g CO2
                    @else
                        <strong>No change in CO2 consumption.</strong>
                    @endif
                </div>
            @endif
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('calculator.calculate') }}" method="POST" id="co2Form">
        @csrf
        <div class="row mb-5">
            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background-color: #C4E4C1;">
                    <div class="card-header" style="background-color: #7CB47C;">
                        <h3 class="mb-0 text-white">🌿 Select Categories</h3>
                    </div>
                    <div class="card-body p-5">
                        <div id="categories-container" class="category-box p-3">
                            @foreach ($categories as $category)
                                <div class="form-check category-item">
                                    <input class="form-check-input category-checkbox" type="checkbox" name="categories[]" value="{{ $category->id }}" id="category-{{ $category->id }}">
                                    <label class="form-check-label text-dark" for="category-{{ $category->id }}">{{ $category->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="card shadow-lg border-0 rounded-lg h-100" style="background-color: #C4E4C1;">
                    <div class="card-header" style="background-color: #7CB47C;">
                        <h3 class="mb-0 text-white">🌱 Select Items</h3>
                    </div>
                    <div class="card-body p-4">
                        <div id="items-container" class="p-3 item-box">
                            <p class="text-muted">Select categories to view items.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success btn-lg w-100 shadow">🌍 Calculate</button>
        </div>
    </form>

    <div class="mt-5">
        <h3 class="text-success">Recent Calculations</h3>
        <div class="card shadow-lg border-0 rounded-lg" style="background-color: #C4E4C1;">
            <div class="card-body p-4">
                <table class="table table-hover table-bordered text-center align-middle mt-3" style="background-color: rgba(0, 128, 0, 0.8);">
                    <thead style="background-color: #7CB47C; color: #ffffff;">
                        <tr>
                            <th>Date</th>
                            <th>Total CO2</th>
                            <th>Change</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($recentResults as $result)
                            <tr style="background-color: #4CAF50;" onmouseover="this.style.backgroundColor='#B3E5B3';" onmouseout="this.style.backgroundColor='#4CAF50';">
                                <td>{{ \Carbon\Carbon::parse($result->created_at)->format('d M Y') }}</td>
                                <td>{{ number_format($result->total_co2) }} g CO2</td>
                                <td>
                                    @if ($result->difference > 0)
                                        <span class="text-danger">Increased by {{ $result->difference }} g CO2</span>
                                    @elseif ($result->difference < 0)
                                        <span class="text-success">Reduced by {{ abs($result->difference) }} g CO2</span>
                                    @else
                                        No change in CO2 consumption
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
</div>

<style>
    .category-item {
        transition: transform 0.2s ease;
        font-size: 1.2rem;
    }

    .category-item:hover {
        transform: scale(1.05);
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 8px;

    }

    .item-box {
        border: 1px solid #ddd;
        background: rgba(255, 255, 255, 0.2);
        border-radius: 8px;
        min-height: 100px;
        font-size: 1.2rem;
    }

    .card {
        background-color: #C4E4C1;
        border: none;
        border-radius: 8px;
    }

    .card-header {
        background-color: #7CB47C;
        color: #ffffff;
    }

     .table th{
        background-color: #7CB47C;
        color: #ffffff;
    }
   
    .table td {
        
    }

    .form-check-input:checked {
        background-color: #4CAF50;
    }

    .fade-in-item {
        animation: fadeIn 0.5s;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    table {
        border-radius: 8px;
    }

    th, td {
        color: #ffffff;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const categoriesContainer = document.getElementById('categories-container');
        const itemsContainer = document.getElementById('items-container');
        const form = document.getElementById('co2Form');
        const submitBtn = document.querySelector('.btn-success');

        categoriesContainer.addEventListener('change', function(e) {
            if (e.target && e.target.classList.contains('form-check-input')) {
                const selectedCategories = Array.from(categoriesContainer.querySelectorAll('.form-check-input:checked')).map(input => input.value);
                fetchItems(selectedCategories);
            }
        });

        function fetchItems(categories) {
            itemsContainer.innerHTML = '<div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div>';

            if (categories.length === 0) {
                itemsContainer.innerHTML = '<p class="text-muted">Select categories to view items.</p>';
                return;
            }

            fetch('{{ route('calculator.getItems') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ categories: categories })
            })
            .then(response => response.json())
            .then(data => {
                itemsContainer.innerHTML = '';
                if (data.items.length > 0) {
                    data.items.forEach(item => {
                        const itemHtml = `
                            <div class="form-check mb-2 fade-in-item">
                                <input class="form-check-input" type="checkbox" name="items[]" value="${item.id}" id="item-${item.id}">
                                <label class="form-check-label text-dark" for="item-${item.id}">
                                    ${item.name} - ${item.co2_value} CO2
                                </label>
                            </div>
                        `;
                        itemsContainer.innerHTML += itemHtml;
                    });
                } else {
                    itemsContainer.innerHTML = '<p class="text-muted">No items available for selected categories.</p>';
                }
            })
            .catch(error => {
                console.error('Error fetching items:', error);
            });
        }

        form.addEventListener('submit', function(e) {
            const selectedItems = Array.from(document.querySelectorAll('input[name="items[]"]:checked'));
            if (selectedItems.length === 0) {
                e.preventDefault();
                alert('Please select at least one item.');
                return;
            }
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Calculating...';
        });
    });
</script>

@endsection
