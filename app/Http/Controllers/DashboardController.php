<?php

namespace App\Http\Controllers;

use App\Models\AcceptedIntern;
use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Basic stats
        $stats = [
            'total' => Intern::count(),
            'pending' => Intern::where('status', 'pending')->count(),
            'approved' => Intern::where('status', 'approved')->count(),
            'rejected' => Intern::where('status', 'rejected')->count(),
            'male' => Intern::where('jenis_kelamin', 'Laki-laki')->count(),
            'female' => Intern::where('jenis_kelamin', 'Perempuan')->count(),
        ];

        // Acceptance stats
        $acceptanceStats = [
            'total_accepted' => AcceptedIntern::count(),
            'pending_approval' => AcceptedIntern::where('approval_status', 'pending')->count(),
            'sent_to_divhead' => AcceptedIntern::where('approval_status', 'sent_to_divhead')->count(),
            'approved_divhead' => AcceptedIntern::where('approval_status', 'approved_divhead')->count(),
            'sent_to_deputy' => AcceptedIntern::where('approval_status', 'sent_to_deputy')->count(),
            'approved_deputy' => AcceptedIntern::where('approval_status', 'approved_deputy')->count(),
            'rejected' => AcceptedIntern::where('approval_status', 'rejected')->count(),
        ];

        // Chart data - Program Studi Distribution
        $programStudiData = Intern::select('program_studi', DB::raw('count(*) as total'))
            ->whereNotNull('program_studi')
            ->groupBy('program_studi')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Asal Kampus Distribution
        $kampusData = Intern::select('asal_kampus', DB::raw('count(*) as total'))
            ->whereNotNull('asal_kampus')
            ->groupBy('asal_kampus')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Unit Magang Distribution
        $unitData = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->select('unit_magang', DB::raw('count(*) as total'))
            ->whereNotNull('unit_magang')
            ->groupBy('unit_magang')
            ->orderByDesc('total')
            ->get();

        // Monthly registration trend (last 6 months)
        $monthlyTrend = Intern::select(
            DB::raw('YEAR(created_at) as year'),
            DB::raw('MONTH(created_at) as month'),
            DB::raw('count(*) as total')
        )
            ->where('created_at', '>=', now()->subMonths(6))
            ->groupBy('year', 'month')
            ->orderBy('year')
            ->orderBy('month')
            ->get()
            ->map(function ($item) {
                $months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
                $item->month_name = $months[$item->month - 1] . ' ' . $item->year;
                return $item;
            });

        return view('dashboard', compact(
            'stats',
            'acceptanceStats',
            'programStudiData',
            'kampusData',
            'unitData',
            'monthlyTrend'
        ));
    }
}
