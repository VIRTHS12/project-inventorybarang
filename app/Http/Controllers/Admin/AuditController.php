<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AuditTrail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AuditController extends Controller
{
    /**
     * Menampilkan halaman daftar jejak audit.
     */
    public function index(Request $request): View
    {
        // Mulai query builder
        $query = AuditTrail::with(['user', 'auditable'])
            ->latest(); // Urutkan berdasarkan yang terbaru

        // Terapkan filter tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        // Terapkan filter pengguna
        if ($request->filled('user')) {
            $query->where('user_id', $request->user);
        }

        // Ambil data dengan paginasi
        $audits = $query->paginate(15)->withQueryString();

        // Ambil semua user untuk dropdown filter
        $users = User::orderBy('name')->get();

        return view('admin.audit', compact('audits', 'users'));
    }
}
