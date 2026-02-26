<?php

namespace App\Http\Controllers;

use App\Models\AcceptedIntern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ApprovalController extends Controller
{
    /**
     * Display approval list for Div Head
     */
    public function divHeadIndex()
    {
        $pendingApprovals = AcceptedIntern::with(['intern', 'creator'])
            ->where('approval_status', 'sent_to_divhead')
            ->orderBy('sent_to_divhead_at', 'desc')
            ->get();

        $approvedByMe = AcceptedIntern::with(['intern', 'creator'])
            ->where('approved_by_divhead', Auth::id())
            ->whereIn('approval_status', ['approved_divhead', 'sent_to_deputy', 'approved_deputy'])
            ->orderBy('approved_divhead_at', 'desc')
            ->get();

        return view('approvals.divhead.index', compact('pendingApprovals', 'approvedByMe'));
    }

    /**
     * Approve by Div Head and forward to Deputy
     */
    public function divHeadApprove(Request $request, $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'sent_to_divhead') {
            return back()->with('error', 'Status approval tidak valid.');
        }

        $acceptedIntern->update([
            'approval_status' => 'sent_to_deputy',
            'approved_divhead_at' => now(),
            'approved_by_divhead' => Auth::id(),
            'sent_to_deputy_at' => now(),
        ]);

        return back()->with('success', 'Pengajuan berhasil disetujui dan diteruskan ke Deputy.');
    }

    /**
     * Reject by Div Head
     */
    public function divHeadReject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'sent_to_divhead') {
            return back()->with('error', 'Status approval tidak valid.');
        }

        $acceptedIntern->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by_divhead' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan telah ditolak.');
    }

    /**
     * Display approval list for Deputy
     */
    public function deputyIndex()
    {
        $pendingApprovals = AcceptedIntern::with(['intern', 'creator', 'approverDivHead'])
            ->where('approval_status', 'sent_to_deputy')
            ->orderBy('sent_to_deputy_at', 'desc')
            ->get();

        $approvedByMe = AcceptedIntern::with(['intern', 'creator', 'approverDivHead'])
            ->where('approved_by_deputy', Auth::id())
            ->where('approval_status', 'approved_deputy')
            ->orderBy('approved_deputy_at', 'desc')
            ->get();

        return view('approvals.deputy.index', compact('pendingApprovals', 'approvedByMe'));
    }

    /**
     * Final Approve by Deputy
     */
    public function deputyApprove(Request $request, $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'sent_to_deputy') {
            return back()->with('error', 'Status approval tidak valid.');
        }

        $acceptedIntern->update([
            'approval_status' => 'approved_deputy',
            'approved_deputy_at' => now(),
            'approved_by_deputy' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan berhasil disetujui secara final.');
    }

    /**
     * Reject by Deputy
     */
    public function deputyReject(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'sent_to_deputy') {
            return back()->with('error', 'Status approval tidak valid.');
        }

        $acceptedIntern->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by_deputy' => Auth::id(),
        ]);

        return back()->with('success', 'Pengajuan telah ditolak.');
    }

    /**
     * Show detail of approval
     */
    public function show($id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern', 'creator', 'approverDivHead', 'approverDeputy'])
            ->findOrFail($id);

        return view('approvals.show', compact('acceptedIntern'));
    }
}
