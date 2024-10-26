@extends('layouts.dashboard')

@section('content')
<div class="container">
    <h1>Items List</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('items.create') }}" class="btn btn-success mb-3">Create New Item</a>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>CO2 Value</th>
                <th>Category</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->co2_value }}</td>
                    <td>{{ $item->category->name }}</td>
                    <td>
                        <a href="{{ route('items.edit', $item->id) }}" class="btn btn-success btn-sm">Edit</a>
                        <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $items->links() }}
</div>
@endsection