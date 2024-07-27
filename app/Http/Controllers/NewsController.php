<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\News;
use App\Models\User;
use App\Jobs\SendNewsletter;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function __construct(
        public ActivityLogger $activityLogger
    ) {}
    public function create() {
        return view('news.create');
    }

    public function index() {
        $news = News::paginate(2);
        return view('news.index', compact('news'));
    }

    public function test() {
        $subscribers = DB::table('subscribers')->get();
        // Dispatch the job to send the newsletter
        SendNewsletter::dispatch($subscribers, "Testing Newsletter");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => ['required', 'min:2'],
            'content' => ['required', 'min:50'],
            'thumbnail' => ['required', 'image'],
        ]);

        $thumbnailPath = $request->file('thumbnail')->store('news', 'public');

        $is_saved = News::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
            'thumbnail' => $thumbnailPath,
        ]);

        if ($is_saved) {
            // Log activity
            $this->activityLogger->logActivity(auth()->id(), 'News Created', 'This user created an article with title ' . $validated['title']);
            // Get all subscribers
            $subscribers = DB::table('subscribers')->get();

            // Dispatch the job to send the newsletter
            SendNewsletter::dispatch($subscribers, $validated['title'], $is_saved->id);

            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'News uploaded successfully.']);
        } else {
            $this->activityLogger->logActivity(auth()->id(), 'News Upload Failed', 'Attempt to upload news failed ' . $validated['title']);
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Failed to upload news.']);
        }
    }

    public function show(News $news) {
        return view('news.show', compact('news'));
    }

    public function destroy($id)
    {
        $newsItem = News::findOrFail($id);


        // Delete the associated thumbnail from storage
        if ($newsItem->thumbnail && Storage::exists('public/' . $newsItem->thumbnail)) {
            Storage::delete('public/' . $newsItem->thumbnail);
        }

        // Delete the news item
        $newsItem->delete();

        // Log activity
        $this->activityLogger->logActivity(auth()->id(), 'News Deleted', 'This user deleted an article with title ' . $newsItem->title);

        return redirect()->route('news.index')->with('alert', ['type' => 'success', 'message' => 'News item deleted successfully.']);
    }

    public function edit(News $news)
    {
        // Pass the news item to the view for editing
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
{
    // Validate the request data
    $validated = $request->validate([
        'title' => ['required', 'string', 'max:255'],
        'content' => ['required', 'string'],
        'thumbnail' => ['nullable', 'image', 'mimes:jpg,jpeg,png,bmp,tiff']
    ]);

    // Update the news item
    $news->title = $validated['title'];
    $news->content = $validated['content'];

    // Check if a new thumbnail was uploaded
    if ($request->hasFile('thumbnail')) {
        // Delete the old thumbnail if exists
        if ($news->thumbnail && Storage::exists('public/' . $news->thumbnail)) {
            Storage::delete('public/' . $news->thumbnail);
        }

        // Store the new thumbnail and update the path
        $thumbnailPath = $request->file('thumbnail')->store('news', 'public');
        $news->thumbnail = $thumbnailPath;
    }

    // Save the updated news item
    $news->save();

    // Redirect with success message
    return redirect()->route('news.index')->with('alert', ['type' => 'success', 'message' => 'News updated successfully.']);
}




}
