@extends('layouts.dashboard')

@section('content')
<div class="container mt-4">
    <h1 class="display-4 text-success mb-5 animate__animated animate__fadeInDown">Categories</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('categories.create') }}" class="btn btn-success mb-3 shadow">Add New Category</a>

    <div class="table-responsive">
        <table class="table table-hover table-bordered text-center align-middle shadow-lg border-0 rounded-lg" style="background-color: rgba(0, 128, 0, 0.8);">
            <thead style="background-color: #7CB47C; color: #ffffff;">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr style="background-color: #4CAF50;" onmouseover="this.style.backgroundColor='#B3E5B3';" onmouseout="this.style.backgroundColor='#4CAF50';">
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm mb-1">Edit</a>
                            <form action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Custom CSS -->
<style>
    /* Main Heading and Button Styling */
    .display-4 { font-weight: 700; color: #28a745; }
    .btn-success { background-color: #28a745; border-color: #28a745; }
    .btn-success:hover { background-color: #218838; border-color: #1e7e34; }

    /* Table and Hover Effect */
    .table { border-radius: 8px; box-shadow: 0px 4px 15px rgba(0, 128, 0, 0.3); }
    .table th { background-color: #7CB47C; color: #ffffff; }
    .table td { color: #000000; }
    tr[style] { transition: background-color 0.3s ease; }

    /* Hover Effect for Rows */
    .table-row-hover:hover {
        background-color: #B3E5B3 !important;
    }
</style>
@endsection
