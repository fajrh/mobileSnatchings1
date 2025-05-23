<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AddMapPinController extends Controller
{
    public function index(Request $request) {
        $description = $request->input('description');

        
        echo 'hi ' . $description;
    }
    public function create() {
 
    }
    public function store(Request $request) {
        $validated = $request->validate([
            'description' => 'required|string',
            'lat' => 'required|numeric',
            'long' => 'required|numeric',
            'datetime' => 'required|date',
        ]);

        Product::create($validated);

        // Redirect to the locations view after storing the data
        return redirect()->route('locations.show')->with('success', 'Location added successfully!');
    }
    public function show() {
        $products = Product::all();
        return view('locations', compact('products'));
    }
    public function edit($id) {
        echo 'edit';
    }
    public function update(Request $request, $id) {
        echo 'update';
    }
    public function destroy($id) {
        echo 'destroy';
    }
}
