<?php

namespace App\Http\Controllers;

use App\Models\Price;
use Illuminate\Http\Request;
use App\Services\ActivityLogger;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\TokenMail;

class PriceController extends Controller
{

    public function __construct(
        public ActivityLogger $activityLogger
    ) {}

    public function index()
    {
        if(auth()->user()->is_super_admin || auth()->user()->is_admin) {
            $prices = Price::latest()->get();
        }
        else{
            // $country = auth()->user()->country;
            // $prices = Price::latest()->where('country', $country)->first();
            $user = auth()->user();

            // Get the unique countries where the user has plants
            $countries = $user->plantss->pluck('country')->unique();



            // Initialize an empty array to store the latest prices for each country
            $prices = [];

            // Loop through each country
            foreach ($countries as $country) {
                // Get the latest price for the current country
                $latestPrice = Price::latest()->where('country', $country)->first();

                // If a price is found for the current country, add it to the prices array
                if ($latestPrice) {
                    $prices[] = $latestPrice;
                }
            }
        }


        return view('prices.index', compact('prices') );
    }

    public function create()
    {
        return view('prices.create');
    }


    public function store(Request $request, Price $price)
    {
        $validate = $request->validate([
            'price' => ['required'],
            'country' => ['required'],
            'quantity' => ['required'],
        ]);


        // Start a transaction
        DB::beginTransaction();

        try {
            // Retrieve the last active price for the same country and update its status
            Price::where('country', $validate['country'])->where('status', true)->update(['status' => false]);

            // Create the new price
            $newPrice = $price->create($validate);

            // Commit the transaction
            DB::commit();

            $this->activityLogger->logActivity(auth()->id(), 'Price Created', "Price for amount " . $request->input('price') . " is created");
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Price added successfully.']);
        } catch (\Exception $e) {
            // Rollback the transaction in case of an exception
            DB::rollback();

            $this->activityLogger->logActivity(auth()->id(), 'Price Failed', "Price for amount " . $request->input('price') . " failed to create");
            return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Something went wrong.']);
        }
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function show(Price $price)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function edit(Price $price)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Price $price)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Price  $price
     * @return \Illuminate\Http\Response
     */
    public function destroy(Price $price)
    {
        //
    }
}
