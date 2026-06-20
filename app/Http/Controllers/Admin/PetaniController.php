<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User; // Pastikan Model User diimport
use Illuminate\Http\Request;

class PetaniController extends Controller
{
    public function index()
    {
        // Mengambil semua user yang memiliki role 'petani'
        $petani = User::where('role', 'petani')->get();
        return view('admin.petani.index', compact('petani'));
    }
}