<?php

namespace App\Http\Controllers;

use App\Models\CmoKat;
use App\Models\User;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->id();  // Ambil ID pengguna yang sedang login
        $branchMaster = User::find($id);  // Ambil user BM yang sedang login

        // dd($branchMaster);

        // Pastikan branchMaster memiliki cabang dan hanya ambil CMO dari cabang tersebut
        $branch = $branchMaster->branches->first();
        // dd($branch);
        if ($branch) {
            // Ambil semua CMO di cabang BM (role_id = 2)
            $cmos = $branch->users()->where('role_id', 2)->paginate(10);
            $cmos1 = $branch->users()->where('role_id', 2)->get();
            // dd($cmos1);  // Dump dan die untuk menampilkan daftar CMO
            return inertia('Employee/Index', [
                "cmos" => $cmos,
                'success' => session('success'),
            ]);
        } else {
            // Jika tidak ada cabang
            // dd('No branches found for this Branch Master.');
            return inertia('Employee/Index', [
                "cmos" => [],
                'success' => session('success'),
            ]);
        }
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
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Ambil data CMO berdasarkan ID
        $cmo = User::with('kats')->find($id);

        if (!$cmo) {
            return redirect()->route('employee.index')->with('error', 'CMO not found');
        }
        // Ambil data Kat yang berelasi dengan CMO ini
        $kats = $cmo->kats()->paginate(10);

        // dd($cmo);
        return inertia('Employee/Show', [
            "kats" => $kats,
            "cmo" => $cmo,
            // 'success' => session('success'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
