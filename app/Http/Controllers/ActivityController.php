<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ActivityController extends Controller
{
    public function search(Request $request) {
        return view('audit.search');
    }

    public function search_result(Request $request) {
        $is_true = $request->has('activity');
        $data = $request->input('activity');

        if ($request->isMethod('post') &&  $is_true) {
            if(empty($data)) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Activity is required."]);
            }

            if($data == "all") {
                $logs = ActivityLog::latest()->get();
            } else{
                 $search = $data;
                $logs = ActivityLog::latest()->where('action', 'like', "%$search%")->get();

                if ($logs->isEmpty()) {
                    return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No logs found matching '$search'"]);
                }
            }

            return view('audit.result', compact('logs'));
        } elseif ($request->isMethod('post') && $request->has(['from', 'to'])) {
            $from = $request->input('from') . ' 00:00:00';
            $to = $request->input('to') . ' 23:59:59';;

            $logs = ActivityLog::latest()->whereBetween('created_at', [$from, $to])->get();

            if ($logs->isEmpty()) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No logs found between '$from' and '$to'"]);
            }

            return view('audit.result', compact('logs'));
        } else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Invalid request"]);
        }
    }

    public function redirectToSearch()
    {
        return redirect()->route('activity.search');
    }








}
