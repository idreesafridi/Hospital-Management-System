<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Stripe\Stripe;
use Stripe\Checkout\Session;
use Stripe\Invoice;
use App\Models\Invoice as InvoiceModel;
use Stripe\Event;
use Stripe\Exception\ApiErrorException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\App;

class StripeController extends Controller
{
    public function checkout(Request $request)
    {

        Stripe::setApiKey(env('STRIPE_SECRET'));

        $amount = $request->amount;
//        $amount = 100;
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => [
                [
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'Doctor Appointment',
                        ],
                        'unit_amount' => $amount * 100,
                    ],
                    'quantity' => 1,
                ],
            ],
            'mode' => 'payment',
            'success_url' => url('/success?session_id={CHECKOUT_SESSION_ID}'),
            'cancel_url' => route('cancel'),
            'metadata' => [
            'appointment_id' => $request->appointment_id, // Pass the appointment ID here
            'amount' => $amount, // Pass the amount here
        ],
            'invoice_creation' => [
                'enabled' => true,
                ],
        ]);
//        return $session;


        return redirect($session->url);

    }


    public function success(Request $request)
    {
//        return $request->all();
        $sessionId = $request->get('session_id');
//     return  $sessionId;
        Stripe::setApiKey(env('STRIPE_SECRET'));

        try {
            $session = Session::retrieve($sessionId);
//            return  $session ;
            if ($session->payment_status === 'paid') {
                $invoiceId = $session->invoice;
//                return $invoiceId;
                if (!$invoiceId) {
                    return response()->json(['error' => 'Invoice ID is not available in the session.'], 400);
                }
                // Retrieve the invoice
                $stripeInvoice = Invoice::retrieve($invoiceId);
                $appointmentid = $session->metadata->appointment_id;
                // Save invoice details in the database
                $invoice = new InvoiceModel();
                $invoice->user_id = auth()->id(); 
                $invoice->appointment_id = $appointmentid;
                $invoice->invoice_id = $stripeInvoice->id;
                $invoice->invoice_url = $stripeInvoice->hosted_invoice_url ;
                $invoice->pdf_path = $stripeInvoice->invoice_pdf;
                $invoice->amount = $stripeInvoice->amount_due / 100;
                $invoice->save();
//                return $invoice;

                $appointmentId = $session->metadata->appointment_id; 
                $amount = $session->metadata->amount; 

                // Update the appointment status to 'Paid' and set the amount
                Appointment::where('id', $appointmentId)->update(['status' => 'Paid', 'amount' => $amount]);


//                return redirect()->away($stripeInvoice->hosted_invoice_url);
                return redirect()->route('appointment')->with(['type'=>'success','msg'=>'Payment Was successfully','title'=>'Done!']);

            } else {
                return response()->json(['message' => 'Payment was not successful'], 400);
            }
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function cancel()
    {
        return view('website.payment_cancel');
    }

}
