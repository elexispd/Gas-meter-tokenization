<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Complaint;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\ComplaintMail;
use App\Mail\AdminComplaintMail;
use App\Services\ActivityLogger;
use App\Models\user;



class ComplaintController extends Controller
{

    public function __construct(
        public ActivityLogger $activityLogger
    ) {}

    public function index()
    {
        $complaints = Complaint::latest()->get();
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
        $resolvedBy = $complaint->resolved_by ? User::find($complaint->resolved_by) : null;
        $complaint_details = [
            'id' => $complaint->id,
            'user_id' => $complaint->user_id,
            'subject' => $complaint->subject,
            'description' => $complaint->description,
            'status' => $complaint->status,
            'resolved_by' => $resolvedBy ? $resolvedBy->first_name ." ". $resolvedBy->last_name : null,
            'resolve_approach' => $complaint->resolve_approach,
            'created_at' => Carbon::parse($complaint->created_at)->format('d/m/Y'),
            'updated_at' => Carbon::parse($complaint->updated_at)->format('d/m/Y'),
            'user' => $complaint->user,
        ];

        return response()->json($complaint_details);
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'resolve_approach' => ['required', 'max:80', 'min:2'],
            'complaint_id' => ['required', 'min:1'],
        ]);


        $complaint = Complaint::find($validatedData['complaint_id']);
        if (!$complaint) {
            return response()->json(['success' => false, 'message' => 'Complaint not found.']);
        }

        $complaint->resolve_approach = $validatedData['resolve_approach'];
        $complaint->resolved_by = auth()->id();
        $complaint->status = true;
        $updated = $complaint->save();

        if ($updated) {
            $this->activityLogger->logActivity(auth()->id(), 'Complaint Updated', 'Complaint with ID ' . $validatedData['complaint_id'] . ' was resolved');
            return response()->json(['success' => true, 'message' => 'Complaint resolved successfully.']);
        } else {
            $this->activityLogger->logActivity(auth()->id(), 'Complaint Update Failed', 'Complaint with ID ' . $validatedData['complaint_id'] . ' failed to resolve');
            return response()->json(['success' => false, 'message' => 'Failed to resolve complaint.']);
        }
    }

}
