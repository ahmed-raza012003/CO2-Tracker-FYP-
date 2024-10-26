
@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Create New Item</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('items.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control" id="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
            <label for="co2_value" class="form-label">CO2 Value</label>
            <input type="number" step="any" name="co2_value" class="form-control" id="co2_value" value="{{ old('co2_value') }}" required>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" class="form-select" id="category_id" required>
                <option value="" disabled>Select a Category</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Create Item</button>
        <a href="{{ route('items.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection