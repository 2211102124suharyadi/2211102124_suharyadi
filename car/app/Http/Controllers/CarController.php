<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Merk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class CarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $cars = Car::with('merk')->get();
            return view('car.index', compact('cars'));
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to load cars: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try {
            $merks = Merk::all();
            return view('car.create', compact('merks'));
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to load form: ' . $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'merk_id' => 'required|exists:merks,id',
                'model' => 'required',
                'color' => 'required',
                'year' => 'required|numeric',
                'price' => 'required|numeric',
                'image' => 'required|image|mimes:jpg,jpeg,png'
            ]);

            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('car_images', 'public');
            }

            Car::create($data);

            return redirect()->route('car.index')->with('message', 'Car added successfully!');
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to add car: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $car = Car::with('merk')->findOrFail($id);
            return view('car.show', compact('car'));
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to load car details: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $car = Car::findOrFail($id);
            $merks = Merk::all();
            return view('car.edit', compact('car', 'merks'));
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to load edit form: ' . $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $car = Car::findOrFail($id);

            $data = $request->validate([
                'merk_id' => 'required|exists:merks,id',
                'model' => 'required',
                'color' => 'required',
                'year' => 'required|numeric',
                'price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpg,jpeg,png'
            ]);

            if ($request->hasFile('image')) {
                if ($car->image) {
                    Storage::disk('public')->delete($car->image);
                }
                $data['image'] = $request->file('image')->store('car_images', 'public');
            }

            $car->update($data);
            return redirect()->route('car.index')->with('message', 'Car updated successfully!');
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to update car: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try {
            $car = Car::findOrFail($id);
            if ($car->image) {
                Storage::disk('public')->delete($car->image);
            }
            $car->delete();
            return redirect()->route('car.index')->with('message', 'Car deleted successfully!');
        } catch (Exception $e) {
            return redirect()->route('car.index')->withErrors('Failed to delete car: ' . $e->getMessage());
        }
    }
}
