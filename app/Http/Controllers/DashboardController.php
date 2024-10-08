<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Ambil ID pengguna yang sedang login
        $branchMasterId = auth()->id(); // ID dari pengguna yang sedang login
        // Ambil cabang dari pengguna yang sedang login
        $branch = User::find($branchMasterId)->branches()->first();

        if (!$branch) {
            return redirect()->route('home')->with('error', 'Branch not found');
        }

        // Mengambil data NIK, nama lengkap, nama wilayah, nama cabang, dan nama kategori
        $data = DB::table('users as u')
            ->join('user_branches as ub', 'u.id', '=', 'ub.user_id')
            ->join('branches as b', 'ub.branch_id', '=', 'b.id')
            ->join('regions as r', 'b.region_id', '=', 'r.id')
            ->leftJoin('cmo_kats as ck', 'u.id', '=', 'ck.cmo_id')
            ->leftJoin('kats as k', 'ck.kat_id', '=', 'k.id')
            ->select(
                'u.nik',
                'u.name as full_name',
                'r.name as region_name',
                'b.name as branch_name',
                'k.name as kat_name'
            )
            ->where('u.role_id', 2) // Pastikan ini untuk CMO
            ->where('b.id', $branch->id) // Hanya ambil CMO di cabang yang sama dengan branch master
            ->paginate(10);

        // dd($data);
        return inertia('Dashboard', [
            'dataAll' => $data,
        ]);
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
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
