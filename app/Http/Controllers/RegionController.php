<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\User;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->id();  // Ambil ID pengguna yang sedang login
        $user = User::find($id);
        if ($user->role_id == "3") {
            $regions = Region::paginate(10);
            // dd($employees);
            return inertia('Region/IndexMSP', [
                'regions' => $regions,
                'success' => session('success'),
            ]);
        } else {
            return inertia('Region/Index');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Region/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $region = new Region;
        $region->name = $request->name;
        $region->save();

        return to_route('region.index')->with('success', 'Region was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Region $region)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Region $region)
    {
        // dd($region);
        return inertia("Region/Edit", [
            "region" => $region,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Region $region)
    {
        $id = $region->id;

        $region = Region::find($id);

        $region->name = $request->name;

        $region->save();

        return to_route('region.index')->with('success', "Region \"$region->name\" was updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Region $region)
    {
        $id = $region->id;

        $region = Region::find($id);
        $name = $region->name;
        $region->delete();

        return to_route('region.index')->with('success', "Region \"$name\" was deleted");
    }
}
