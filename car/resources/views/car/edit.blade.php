@extends('layout.app')
 
@section('title', 'Edit Car')
 
@section('content')
<form action="{{ route('car.update', $car) }}" method="POST" enctype="multipart/form-data">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Merk</label>
        <select name="merk_id" class="form-control">
            @foreach ($merks as $merk)
                <option value="{{ $merk->id }}" {{ $car->merk_id == $merk->id ? 'selected' : '' }}>
                    {{ $merk->name }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control" value="{{ $car->model }}">
    </div>
    <div class="mb-3">
        <label>Color</label>
        <input type="text" name="color" class="form-control" value="{{ $car->color }}">
    </div>
    <div class="mb-3">
        <label>Year</label>
        <input type="number" name="year" class="form-control" value="{{ $car->year }}">
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ $car->price }}">
    </div>
    <div class="mb-3">
        <label>Image</label><br>
        <img src="{{ asset('storage/'.$car->image) }}" width="100" alt="Car Image"><br><br>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-success" type="submit">Update</button>
</form>

@endsection