<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintMail;
use App\Mail\AdminComplaintMail;



class ComplaintController extends Controller
{

    public function index()
    {
        $complaints = Complaint::all();
        return view('complaint.admin.index', compact('complaints'));
    }

    public function create()
    {
        return view('complaint.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ]);
        try {
            Complaint::create([
                'subject' => $validated['subject'],
                'description' => $validated['description'],
                'user_id' => auth()->user()->id,
            ]);
            $user = auth()->user();
            Mail::to($user->email)->send(new ComplaintMail($user));
            Mail::to("info@entakgroup.com")->send(new AdminComplaintMail());
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Complaint submitted successfully.']);
        } catch (\Exception $e) {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to save complaint. Please try again.' . $e]);
        }
    }

    public function show(Complaint $complaint)
    {

        if (!$complaint) {
            return response()->json(['error' => 'Detail ID is required'], 400);
        }

        $complaint_details = [
            'id' => $complaint->id,
            'user_id' => $complaint->user_id,
            'subject' => $complaint->subject,
            'description' => $complaint->description,
            'created_at' => Carbon::parse($complaint->created_at)->format('d/m/Y'),
            'user' => $complaint->user,
        ];

        return response()->json($complaint_details);
    }
}
