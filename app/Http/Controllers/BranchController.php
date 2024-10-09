<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Region;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $branches = Branch::with('region')->paginate(10);
        $branches = Branch::join('regions', 'branches.region_id', '=', 'regions.id')
            ->orderBy('regions.name', 'asc')  // Order by region name
            ->select('branches.*')  // Ensure you only select the columns from branches
            ->with('region')  // Eager load the related region
            ->paginate(10);
        // dd($branches);
        return inertia("Branch/IndexMSP", [
            "branches" => $branches
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regions = Region::all();
        return inertia("Branch/Create", [
            "regions" => $regions
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $branch = new Branch;
        $branch->name = $request->name;
        $branch->region_id = $request->region_id;
        $branch->save();

        return to_route('branch.index')->with('success', 'Branch was created');
    }

    /**
     * Display the specified resource.
     */
    public function show(Branch $branch)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Branch $branch)
    {
        $regions = Region::all();
        return inertia("Branch/Edit", [
            "branch" => $branch,
            "regions" => $regions
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Branch $branch)
    {
        $id = $branch->id;

        $branch = Branch::find($id);

        $branch->name = $request->name;
        $branch->region_id = $request->region_id;

        $branch->save();

        return to_route('branch.index')->with('success', "Branch \"$branch->name\" was updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Branch $branch)
    {
        $id = $branch->id;

        $branch = Branch::find($id);
        $name = $branch->name;
        $branch->delete();

        return to_route('branch.index')->with('success', "Branch \"$name\" was deleted");
    }
}
