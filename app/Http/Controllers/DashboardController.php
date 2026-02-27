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

        // Basic stats from public applications (Intern table)
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

        // Chart data from FINAL APPROVED interns (database-magang / approved_deputy)
        // Gender Distribution - from final approved interns
        $genderData = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->join('interns', 'accepted_interns.intern_id', '=', 'interns.id')
            ->select('interns.jenis_kelamin', DB::raw('count(*) as total'))
            ->whereNotNull('interns.jenis_kelamin')
            ->groupBy('interns.jenis_kelamin')
            ->get()
            ->pluck('total', 'jenis_kelamin');

        $stats['male'] = $genderData['Laki-laki'] ?? 0;
        $stats['female'] = $genderData['Perempuan'] ?? 0;

        // Program Studi Distribution - from final approved interns
        $programStudiData = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->join('interns', 'accepted_interns.intern_id', '=', 'interns.id')
            ->select('interns.program_studi', DB::raw('count(*) as total'))
            ->whereNotNull('interns.program_studi')
            ->groupBy('interns.program_studi')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Asal Kampus Distribution - from final approved interns
        $kampusData = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->join('interns', 'accepted_interns.intern_id', '=', 'interns.id')
            ->select('interns.asal_kampus', DB::raw('count(*) as total'))
            ->whereNotNull('interns.asal_kampus')
            ->groupBy('interns.asal_kampus')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        // Unit Magang Distribution - from final approved interns
        $unitData = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->select('unit_magang', DB::raw('count(*) as total'))
            ->whereNotNull('unit_magang')
            ->groupBy('unit_magang')
            ->orderByDesc('total')
            ->get();

        // Monthly trend - from final approved interns (based on approved_deputy_at date)
        $monthlyTrend = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->whereNotNull('approved_deputy_at')
            ->where('approved_deputy_at', '>=', now()->subMonths(6))
            ->select(
                DB::raw('YEAR(approved_deputy_at) as year'),
                DB::raw('MONTH(approved_deputy_at) as month'),
                DB::raw('count(*) as total')
            )
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
