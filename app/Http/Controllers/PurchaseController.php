<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Price;
use App\Models\User;
use Illuminate\Http\Request;
use App\Services\ActivityLogger;
use App\Services\PaystackService;
use App\Services\TokenAPIService;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;
use App\Mail\TokenMail;


class PurchaseController extends Controller
{


    public function __construct(public ActivityLogger $activityLogger, public PaystackService $paymentService, public TokenAPIService $token) {}

    public function index()
    {
        //
    }

    public function create()
    {
        $price = Price::where('status', true)->first();
        return view('purchase.create', compact('price'));
    }

    public function store(Request $request, Purchase $purchase)
    {
        $validate = $request->validate([
            'amount' =>'required|numeric',
            'quantity' =>'required|numeric',
        ]);

        $user = auth()->user();

        $order_id = time() + rand(99, 999);
        $purchase->amount = $request->amount;
        $purchase->quantity = $request->quantity;
        $purchase->order_id = $order_id;
        $purchase->user_id = $user->id;
        $purchase->status = 0;


        if ($purchase->save())  {
            $this->activityLogger->logActivity(auth()->id(), 'Purchase Created', "Purchase for gas initiated. Quantity " . $request->input('quantity') . " amount " . $request->input('price') . " is created");
            // return redirect()->back()->with('alert', ['type' => 'success', 'message' => 'Purchase made successfully.']);
            return response()->json([
                'success' => true,
                'message' => $order_id,
            ]);
        } else {
            $this->activityLogger->logActivity(auth()->id(), 'Purchase Failed', "Purchase for gas initiated. Quantity " . $request->input('quantity') . " amount " . $request->input('price') . " failed to create");
            // return redirect()->back()->with('alert', ['type' => 'error', 'message' => 'Something went wrong.']);
            // Mail::to($user->email)->send(new TokenMail($user));
            return response()->json([
                'success' => false,
                'message' => 'Failed.',
            ]);
        }
    }

    function send_token(Request $request) {
        $user = auth()->user();
        $order_id = $request->get('ref_id');
        $amount = $request->get('quantity');
        $meter_number = $request->meter_number;
        $token_response = $this->purchaseToken($meter_number, $amount);
        if($token_response["result_code"] != 0) {
            return response()->json([
                'success' => false,
                'message' => 'Token could not be generated. In valid Credentials',
            ]);
        } else {
            $token  = $token_response["result"]["token"];
            try {
                $details = Purchase::where('order_id', $order_id)->first();
                try {
                    Mail::to($user->email)->send(new TokenMail($user, $details, $token));
                    return response()->json([
                        'success' => true,
                        'message' => 'Mail sent successfully.',
                    ]);
                } catch (\Exception $e) {
                    // Handle mail sending error
                    return response()->json([
                        'success' => false,
                        'message' => 'Failed to send mail: ' . $e->getMessage(),
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'success' => false,
                    'message' => 'No record of order found. '. $e->getMessage(),
                ]);
            }
        }

    }

    public function show(Purchase $purchase)
    {
        //
    }


    public function edit(Purchase $purchase)
    {
        //
    }




    public function update(Request $request)
    {


        $ref_id = $request->input('ref_id');
        $status = $request->input('status');
        $purchase = Purchase::where('order_id', $ref_id)->first();


        if (!$purchase) {
            return response()->json([
                'success' => false,
                'message' => 'Purchase not found.',
            ], 404);
        }

        $message = "";
        if ($status == 1) {
            $message = "is successful";
        } else {
            $message = "is canceled";
        }

        $purchase->status = $status;
        if ($purchase->save()) {
            $this->activityLogger->logActivity(auth()->id(), 'Purchase Updated', "Purchase for gas with order ID " . $ref_id .  " " . $message);
            return response()->json([
                'success' => true,
                'message' => 'Updated.',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update purchase.',
            ], 500);
        }
    }


    public function destroy(Purchase $purchase)
    {
        //
    }

    public function search()
    {
        return view('payments.search-payment');
    }

    public function search_result(Request $request)
    {
        // Check if the request is a POST request with an 'order_id' parameter
        if ($request->isMethod('post') && $request->has('order_id')) {
            $order_id = $request->input('order_id');
            $search = $order_id;
            $payment = Purchase::where('order_id', $search)->first();
            if (!$payment) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Invalid order ID"]);
            }
             // Attach payment response to each payment
            $response = $this->paymentService->verifyPayment($order_id);
            $payment->response = $response; // Attach payment response

            return view('payments.history', compact('payment'));
        }
        // Check if the request is a POST request with 'from', 'to', and 'status' parameters
        elseif ($request->isMethod('post') && $request->has(['from', 'to'])) {
            $from = $request->input('from') . ' 00:00:00';
            $to = $request->input('to') . ' 23:59:59';
            $status = $request->input('status');

            if(empty($from) || empty($to) ) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Invalid date range"]);
            }

            // if($status == "all") {
            //     $payments = Purchase::latest()->whereBetween('created_at', [$from, $to])->get();
            // } else{
            //     // Perform the search based on the provided range and status
            //     $payments = Purchase::latest()->whereBetween('created_at', [$from, $to])
            //                     ->where('status', $status)
            //                     ->get();
            // }

            $payments = Purchase::latest()->whereBetween('created_at', [$from, $to])
            ->when($status !== 'all', function ($query) use ($status) {
                return $query->where('status', $status);
            })
            ->get();

            if(!$payments) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No payments found"]);
            }

            // Attach payment response to each payment
            // foreach ($payments as $payment) {
            //     $response = $this->paymentService->verifyPayment($payment->order_id);
            //     $payment->response = $response; // Attach payment response
            // }
            foreach ($payments as $payment) {
                $cacheKey = 'payment_response_' . $payment->order_id;
                $response = Cache::remember($cacheKey, now()->addHour(), function () use ($payment) {
                    return $this->paymentService->verifyPayment($payment->order_id);
                });
                $payment->response = $response; // Attach payment response
            }
            return view('payments.history', compact('payments'));
        }
        elseif ($request->isMethod('post') && $request->has('meter_number')) {
            $meter_number = $request->get('meter_number');
            if(empty($meter_number)){
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Meter number is required"]);
            }
            $user = User::where('meter_number', $request->get('meter_number'))->first();
            if(!$user) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "User not found"]);
            }
            $payments = Purchase::latest()->where('user_id', $user->id)->get();
            // Attach payment response to each payment
            foreach ($payments as $payment) {
                $response = $this->paymentService->verifyPayment($payment->order_id);
                $payment->response = $response; // Attach payment response
            }
            return view('payments.history', compact('payments'));
        }
        // If none of the conditions are met, redirect to the search page
        else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No payments found"]);
        }
    }

    public function tenant_search()
    {
        return view('payments.tenant.index');
    }

    public function tenant_search_result(Request $request)
    {

        // Check if the request is a POST request with 'from', 'to', and 'status' parameters
        if ($request->isMethod('post') && $request->has(['from', 'to'])) {
            $from = $request->input('from') . ' 00:00:00';
            $to = $request->input('to') . ' 23:59:59';



            if(empty($from) || empty($to) ) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "Invalid date range"]);
            }



           $users = auth()->user()->usersUsingMyPlants()->pluck('id');


            $payments = Purchase::latest()
            ->whereIn('user_id', $users)
            ->whereBetween('created_at', [$from, $to])
            ->where("status", 1)->get();

            if(!$payments) {
                return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No payments found"]);
            }
            foreach ($payments as $payment) {
                $cacheKey = 'payment_response_' . $payment->order_id;
                $response = Cache::remember($cacheKey, now()->addHour(), function () use ($payment) {
                    return $this->paymentService->verifyPayment($payment->order_id);
                });
                $payment->response = $response; // Attach payment response
            }
            return view('payments.history', compact('payments'));
        }

        else {
            return redirect()->back()->with('alert', ['type' => 'error', 'message' => "No payments found"]);
        }
    }



    public function redirectToSearch()
    {
        return redirect()->route('payment.search');
    }

    public function verifyPayment($order_id) {
        return response()->json(['status' => $this->paymentService->verifyPayment($order_id) ]);
    }


    public function purchaseToken($meter_number, $amount) {
        $payload = [
            "company_name"=> env('TOKEN_COMPANY_NAME'),
            "user_name"=> env('TOKEN_USERNAME'),
            "password"=> env('TOKEN_PASSWORD'),
            "password_vend"=> env('TOKEN_VEND_PASSWORD'),
            "meter_number"=> $meter_number,
            "is_vend_by_unit"=> true,
            "amount"=> $amount,
        ];

        $response = $this->token->generateToken($payload);
        return $response;
    }










}
