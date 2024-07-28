<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ActivityLogger;
use App\Models\Career;

class CareerController extends Controller
{

    public function __construct(
        public ActivityLogger $activityLogger
    ) {}
    public function create() {
        return view('career.create');
    }

    public function index() {
        $careers = career::paginate(2);
        return view('career.index', compact('careers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:2'],
            'content' => ['required', 'min:50'],
        ]);

        $is_saved = Career::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id()
        ]);

        if ($is_saved) {
            // Log activity
            $this->activityLogger->logActivity(auth()->id(), 'career Created', 'This user created a vacancy with title ' . $validated['title']);
            // Get all subscribers


            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'career published successfully.']);
        } else {
            $this->activityLogger->logActivity(auth()->id(), 'career Upload Failed', 'Attempt to publish career failed ' . $validated['title']);
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to publish career.']);
        }
    }

    public function show(career $career) {
        return view('career.show', compact('career'));
    }

    public function destroy($id)
    {
        $careerItem = Career::findOrFail($id);

        // Delete the career item
        $careerItem->delete();

        // Log activity
        $this->activityLogger->logActivity(auth()->id(), 'career Deleted', 'This user deleted a vacancy with title ' . $careerItem->title);

        return redirect()->route('career.index')->with('alert', ['type' => 'success', 'message' => 'career item deleted successfully.']);
    }

    public function edit(Career $career)
    {
        // Pass the career item to the view for editing
        return view('career.edit', compact('career'));
    }

    public function update(Request $request, Career $career)
{
    // Validate the request data
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
        'status' => ['required', 'boolean']
    ]);

    // Update the career item
    $career->title = $validated['title'];
    $career->content = $validated['content'];
    $career->status = $validated['status'];

    // Save the updated career item
    $career->save();

    // Redirect with success message
    return redirect()->route('career.index')->with('alert', ['type' => 'success', 'message' => 'Vacancy updated successfully.']);
}
}
