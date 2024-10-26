@extends('layouts.dashboard')

@section('content')
    <h1 class="text-success">Add Category</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Category Name</label>
            <input type="text" name="name" class="form-control" id="name" placeholder="Enter category name">
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
