@extends('layout.app')
 
@section('title', 'Car Details')
 
@section('content')
    <div class="card">
        <div class="card-header">
            Detail Mobil: {{ $car->model }}
        </div>
        <div class="card-body">
            <p><strong>Merk:</strong> {{ $car->merk->name }}</p>
            <p><strong>Model:</strong> {{ $car->model }}</p>
            <p><strong>Color:</strong> {{ $car->color }}</p>
            <p><strong>Year:</strong> {{ $car->year }}</p>
            <p><strong>Price:</strong> Rp {{ number_format($car->price, 0, ',', '.') }}</p>
            <img src="{{ asset('storage/'.$car->image) }}" width="200" alt="Car Image">
        </div>
        <div class="card-footer">
            <a href="{{ route('car.index') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
@endsection