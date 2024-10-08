<?php

namespace App\Http\Controllers;

use App\Models\CmoKat;
use App\Models\Kat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = auth()->id();  // Ambil ID pengguna yang sedang login
        $user = User::find($id);

        if ($user->role_id == "3") {
            $employees = User::where('role_id', 1)->paginate(10);
            // $branches =
            // dd($employees);
            return inertia('Employee/IndexMSP', [
                'employees' => $employees,
            ]);
        } else {

            $branchMaster = User::find($id);  // Ambil user BM yang sedang login

            // dd($branchMaster);

            // Pastikan branchMaster memiliki cabang dan hanya ambil CMO dari cabang tersebut
            $branch = $branchMaster->branches->first();
            // dd($branch);
            if ($branch) {
                // Ambil semua CMO di cabang BM (role_id = 2)
                $cmos = $branch->users()->where('role_id', 2)->paginate(10);
                // $cmos1 = $branch->users()->where('role_id', 2)->get();
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
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia("Employee/Create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());

        $user = new User;
        $user->nik = $request->nik;
        $user->name = $request->name;
        $user->password = Hash::make('password');
        $user->role_id = 1;
        $user->save();

        // Tambahan Branch
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
            'success' => session('success'),
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

    public function createKat($cmoId)
    {
        // Cari CMO berdasarkan ID
        $cmo = User::find($cmoId);

        if (!$cmo) {
            return redirect()->route('employee.index')->with('error', 'CMO not found');
        }

        // Ambil semua Kat yang belum terhubung dengan CMO ini
        $availableKats = Kat::whereNotExists(function ($query) {
            $query->select(DB::raw(1))
                ->from('cmo_kats')
                ->whereRaw('cmo_kats.kat_id = kats.id');
        })->get();

        return inertia('Employee/AddKat', [
            "cmo" => $cmo,
            "availableKats" => $availableKats,
        ]);
    }

    public function storeKat(Request $request, $cmoId)
    {
        // Validasi input
        $request->validate([
            'kat_ids' => 'required|array',
            'kat_ids.*' => 'exists:kats,id',
        ]);

        // Cari CMO berdasarkan ID
        $cmo = User::find($cmoId);

        if (!$cmo) {
            return redirect()->route('employee.index')->with('error', 'CMO not found');
        }

        // Attach multiple Kats ke CMO
        $cmo->kats()->attach($request->kat_ids);

        return redirect()->route('employee.show', $cmoId)->with('success', 'Kats added successfully');
    }
}
