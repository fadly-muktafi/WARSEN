<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RestaurantTable;
use Illuminate\Http\Request;

class RestaurantTableController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = RestaurantTable::latest()->paginate(10);
        return view('admin.tables.index', compact('tables'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.tables.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nomor_meja' => 'required|string|unique:restaurant_tables,nomor_meja',
            'status' => 'required|in:available,occupied',
        ]);

        RestaurantTable::create([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
        ]);

        return to_route('admin.tables.index')->with('success', 'Table created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantTable $restaurantTable)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantTable $table)
    {
        return view('admin.tables.edit', compact('table'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RestaurantTable $table)
    {
        $request->validate([
            'nomor_meja' => 'required|string|unique:restaurant_tables,nomor_meja,' . $table->id,
            'status' => 'required|in:available,occupied',
        ]);

        $table->update([
            'nomor_meja' => $request->nomor_meja,
            'status' => $request->status,
        ]);

        return to_route('admin.tables.index')->with('success', 'Table updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantTable $table)
    {
        $table->delete();

        return to_route('admin.tables.index')->with('danger', 'Table deleted successfully.');
    }
}
