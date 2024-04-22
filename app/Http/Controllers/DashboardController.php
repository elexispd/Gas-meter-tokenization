<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Plant;
use App\Models\Purchase;
use Illuminate\Support\Facades\Http;

class DashboardController extends Controller
{
    public function index() {
        $tenant_count = User::where('is_tenant', true)->count();
        $user_count = User::whereNotNull('meter_number')->count();
        $sales_count = Purchase::whereNot('status', true)->count();
        $plant_count = Plant::count();
        return view('dashboard', compact('tenant_count', 'user_count','sales_count', 'plant_count'));
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
