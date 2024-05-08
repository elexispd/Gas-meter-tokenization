<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plant;
use App\Models\Purchase;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {


// Get the current date
        $currentDate = Carbon::today();
        $tenant_count = User::where('is_tenant', true)->count();
        $user_count = User::whereNotNull('meter_number')->count();
        $sales_count = Purchase::whereNot('status', true)->count();
        $sales_today_count = Purchase::where('status', true)
                    ->whereDate('created_at', $currentDate)
                    ->sum('amount');
        $volume_today_count = Purchase::where('status', true)
                    ->whereDate('created_at', $currentDate)
                    ->sum('quantity');
        $plant_count = Plant::count();

        $tenant = auth()->user()->is_tenant;
        if($tenant == 1) {
            $plants = plant::where('tenant_id', auth()->user()->id)->get();
        }else{
            $plants = [];
        }

        return view('dashboard', compact('tenant_count', 'user_count','sales_count', 'plant_count', 'sales_today_count', 'volume_today_count', 'plants'));
    }


    public function get_revenue(Request $request)
    {
        $currentDate = Carbon::today();
        $selectedCountry = $request->input('country');

        // Calculate the total amount made for today by the selected country
        $sales_today_count = Purchase::whereHas('user.plants', function ($query) use ($selectedCountry) {
            $query->where('country', $selectedCountry);
        })->where('status', true)
            ->whereDate('created_at', $currentDate)
            ->sum('amount');


        // Return the total amount as JSON
        return response()->json(['sales_today_count' => number_format($sales_today_count,2)]);
    }






    public function getChartData()
    {
        $data = Purchase::select('created_at', 'quantity')->where("status", true)->get();
        return response()->json($data);
    }


    public function consumeApi(Request $request)
    {


        // Prepare the API request parameters
        $params = $request->only(['mprn', 'address_id', 'postcode']);
        $params = ["1234-567-89AB", "12 Collwg Rd", "1233"];

        // Make the API request
        try {
            $response = Http::get('https://api.example.com/supply-meter-point', $params);

            // Check if the request was successful
            if ($response->successful()) {
                // Extract the data from the response
                $data = $response->json();

                // Process the data as needed

                dd(response()->json($data));
            } else {
                // Handle API errors
                dd(response()->json(['error' => 'Failed to retrieve data from the API'], $response->status()));
            }
        } catch (\Exception $e) {
            // Handle exceptions
            dd(response()->json(['error' => $e->getMessage()], 500));
        }
    }


}
