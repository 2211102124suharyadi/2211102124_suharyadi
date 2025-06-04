@extends('layout.app')
 
@section('title', 'Add New Car')
 
@section('content')
<form action="{{ route('car.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label>Merk</label>
        <select name="merk_id" class="form-control">
            @foreach ($merks as $merk)
                <option value="{{ $merk->id }}">{{ $merk->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label>Model</label>
        <input type="text" name="model" class="form-control">
    </div>
    <div class="mb-3">
        <label>Color</label>
        <input type="text" name="color" class="form-control">
    </div>
    <div class="mb-3">
        <label>Year</label>
        <input type="number" name="year" class="form-control">
    </div>
    <div class="mb-3">
        <label>Price</label>
        <input type="number" name="price" class="form-control">
    </div>
    <div class="mb-3">
        <label>Image</label>
        <input type="file" name="image" class="form-control">
    </div>
    <button class="btn btn-primary" type="submit">Save</button>
</form>
@endsection
 

 
