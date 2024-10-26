@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="display-4 text-success mb-5 animate__animated animate__fadeInDown">Edit Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.update', $item->id) }}" method="POST" class="shadow-lg p-5 rounded-lg" style="background-color: #C4E4C1;">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="name" class="form-label text-success font-weight-bold">Name</label>
            <input type="text" name="name" class="form-control border-0" id="name" value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="mb-4">
            <label for="co2_value" class="form-label text-success font-weight-bold">CO2 Value</label>
            <input type="number" step="any" name="co2_value" class="form-control border-0" id="co2_value" value="{{ old('co2_value', $item->co2_value) }}" required>
        </div>

        <div class="mb-4">
            <label for="category_id" class="form-label text-success font-weight-bold">Category</label>
            <select name="category_id" class="form-select border-0" id="category_id" required>
                <option value="" disabled>Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $item->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success shadow">Update Item</button>
            <a href="{{ route('items.index') }}" class="btn btn-secondary shadow">Cancel</a>
        </div>
    </form>
</div>

<!-- Custom CSS -->
<style>
    .display-4 { font-weight: 700; color: #28a745; }
    .btn-success { background-color: #28a745; border-color: #28a745; }
    .btn-success:hover { background-color: #218838; border-color: #1e7e34; }
    .form-control, .form-select { background-color: #EAF5EA; }
    .shadow-lg { box-shadow: 0px 4px 15px rgba(0, 128, 0, 0.3); }
    .form-label { font-size: 1.2rem; }
</style>
@endsection
