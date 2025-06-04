<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CarResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $cars = Car::latest()->paginate(5);

        //return collection of cars as a resource
        return new CarResource(true, 'List Data cars', $cars);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'merk_id' => 'required|exists:merks,id',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required|numeric',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
                //upload image
        $image = $request->file('image');
        $image->storeAs('public/storage/car_images', $image->hashName());
        $car = Car::create([
            'merk_id' => $request->merk_id,
            'model' => $request->model,
            'color' => $request->color,
            'year' => $request->year,
            'price' => $request->price,
            'image' => $image->hashName(),
        ]);

        //return response
        return new CarResource(true, 'Data Car Berhasil Ditambahkan!', $car);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $car = Car::find($id);

        return new CarResource(true, 'Detail Data Mobil!', $car);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $car = Car::find($id);

        $validator = Validator::make($request->all(), [
            'merk_id' => 'required|exists:merks,id',
            'model' => 'required',
            'color' => 'required',
            'year' => 'required|integer',
            'price' => 'required|integer',
            'image' => 'nullable|image|mimes:jpg,jpeg,png'
        ]);

        //check if validation fails
        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        //check if image is not empty
        if ($request->hasFile('image')) {

            //upload image
            $image = $request->file('image');
            $image->storeAs('public/storage/car_images', $image->hashName());

            //delete old image
            Storage::delete('public/storage/car_images/' . basename($car->image));

            //update car with new image
            $car->update([
                'merk_id' => $request->merk_id,
                'model' => $request->model,
                'color' => $request->color,
                'year' => $request->year,
                'price' => $request->price,
                'image' => $image->hashName(),
            ]);
        } else {

            //update car without image
            $car->update([
                'merk_id' => $request->merk_id,
                'model' => $request->model,
                'color' => $request->color,
                'year' => $request->year,
                'price' => $request->price,
            ]);
        }

        //return response
        return new CarResource(true, 'Data Mobil Berhasil Diubah!', $car);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
             //find book by ID
        $book = Car::find($id);

        //delete image
        Storage::delete('public/storage/car_images/'.basename($book->image));

        //delete book
        $book->delete();

        //return response
        return new CarResource(true, 'Data Book Berhasil Dihapus!', null);
    }
}
