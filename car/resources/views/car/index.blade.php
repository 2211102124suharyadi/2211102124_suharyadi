@extends('layout.app')
 
@section('title', 'Car List')
 
@section('content')
    {{-- Tombol Tambah dan Logout --}}
<div style="margin-bottom: 15px;">
    <a href="{{ route('car.create') }}" class="btn btn-primary">Add Car</a>
         @auth
        <form method="POST" action="{{ route('logout') }}" style="display:inline; float: right;">
            @csrf
            <button type="submit" class="btn btn-danger">
                Logout
            </button>
        </form>
    @endauth

</div>
 
{{-- Pesan Flash --}}

    @if(session('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
    @endif
 
    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th><th>Merk</th><th>Model</th><th>Color</th><th>Year</th><th>Price</th><th>Image</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($cars as $car)
            <tr>
                <td>{{ $car->id }}</td>
                <td>{{ $car->merk->name }}</td>
                <td>{{ $car->model }}</td>
                <td>{{ $car->color }}</td>
                <td>{{ $car->year }}</td>
                <td>Rp {{ number_format($car->price, 0, ',', '.') }}</td>
                <td>
                    <img src="{{ asset('storage/'.$car->image) }}" width="100" alt="Car {{ $car->model }} Image">
                </td>
                <td>
                    <a href="{{ route('car.show', $car->id) }}" class="btn btn-info btn-sm">View</a>
                    <a href="{{ route('car.edit', $car->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('car.destroy', $car->id) }}" method="POST" style="display:inline;">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

@endsection