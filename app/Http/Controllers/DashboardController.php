<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $stats = [
            'total' => 0,
            'pending' => 0,
            'approved' => 0,
            'rejected' => 0,
        ];

        if ($user->role === 'tu') {
            $stats['total'] = Intern::where('created_by', $user->id)->count();
            $stats['pending'] = Intern::where('created_by', $user->id)->where('status', 'pending')->count();
            $stats['approved'] = Intern::where('created_by', $user->id)->where('status', 'approved')->count();
            $stats['rejected'] = Intern::where('created_by', $user->id)->where('status', 'rejected')->count();
        } else {
            $stats['total'] = Intern::count();
            $stats['pending'] = Intern::where('status', 'pending')->count();
            $stats['approved'] = Intern::where('status', 'approved')->count();
            $stats['rejected'] = Intern::where('status', 'rejected')->count();
        }

        return view('dashboard', compact('stats'));
    }
}
