<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        return response()->json(['cars' => $cars], 200);
    }

    public function show($id)
    {

        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        return response()->json(['car' => $car], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
        ]);

        $car = Car::create([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'mileage' => $request->input('mileage'),
        ]);
        return response()->json(['car' => $car], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'make' => 'required|string',
            'model' => 'required|string',
            'year' => 'required|integer',
            'price' => 'required|numeric',
            'mileage' => 'required|integer',
        ]);

        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }

        $car->update([
            'make' => $request->input('make'),
            'model' => $request->input('model'),
            'year' => $request->input('year'),
            'price' => $request->input('price'),
            'mileage' => $request->input('mileage'),
        ]);

        return response()->json(['car' => $car], 200);
    }

    public function destroy($id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        $car->delete();
        return response()->json(['message' => 'Car deleted successfully'], 200);
    }
}
