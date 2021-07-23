<?php

namespace App\Http\Controllers;

use App\Models\GameUser;
use App\Models\Payment;
use App\Models\Sport;
use Exception;
use Illuminate\Http\Request;
use Stripe;
use Session;

class PaymentController extends Controller
{

    private $costPerCredit = 5;

    public function createSession(Request $request)
    {
        $credit = $request->credit ?? 1;
        $name = Session::get('name');

        $session = Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => 'Credit',
                    ],
                    'unit_amount' => 100 * $this->costPerCredit,
                ],
                'quantity' => $credit,
            ]],
            'mode' => 'payment',
            'success_url' => env("APP_URL"),
            'cancel_url' => env("APP_URL"),
        ]);

        $user = GameUser::where("name", $name)->first();
        if (!$user) {
            return response('', 401);
        }

        Payment::create([
            "status" => "initiated",
            "reference" => $session->id,
            "gameuser_id" => $user->id,
            "credit" => $credit,
            "amount" => $credit * $this->costPerCredit
        ]);

        return [
            'id' => $session->id
        ];
    }


    public function webhook(Request $request)
    {

        $contents = $request->getContent();
        $stripeSignature = $request->header("stripe-signature");
        try {
            $event = \Stripe\Webhook::constructEvent($contents, $stripeSignature, env("STRIPE_WEBHOOK_SECRET"));
            if (in_array($event->type, ["checkout.session.completed"], true)) {
                $session = $event->data->object;

                $payment = Payment::where("reference", $session->id)->first();
                $payment->status = $session->payment_status;
                $user = $payment->user;
                $user->increment('credit', $payment->credit);
                $user->save();
                $payment->save();
            }
        } catch (Exception $e) {
            return response([
                "status" => $e->getMessage()
            ], 403);
        }
        return response([
            "status" => "success"
        ], 200);
    }


    public function payments() 
    {


        $sport_id = NULL;
        $sports = Sport::orderBy('created_at', 'desc')->get();
        $first_sport = $sports->first();
        $first_sport_id = $first_sport->sport_id;
        if (Session::get("sport_id")) {
            $sport_id = Session::get("sport_id");
        }
        $name = Session::get('name');

        $user = GameUser::where("name", $name)->first();
        if (!$user) {
            return redirect()->route("home");
        }
        $payments = Payment::where("status", "!=", "initiated")->where("gameuser_id", $user->id)->get();
        return view("payment", compact("payments", 'sports', 'first_sport_id', 'sport_id'));
    }
}
