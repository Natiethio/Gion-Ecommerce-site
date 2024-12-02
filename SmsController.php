<?php

namespace App\Http\Controllers;

use App\Models\Customersell;
use App\Models\Product;
use Illuminate\Http\Request;
use Twilio\Rest\Client;
use Twilio\Exceptions\RestException;
use Illuminate\Support\Facades\Auth;
use Exception;
class SmsController extends Controller
{
    public function sendsms(Request $req, $id)
    {
        $user = Auth::user();
        $message = $req->message;
        $product = Customersell::find($id);
        if ($message) {
            $account_sid = getenv('TWILIO_SID');
            $auth_token = getenv('TWILIO_TOKEN');
            $twilio_number = getenv('TWILIO_PHONE');

            try {
                $client = new Client($account_sid, $auth_token);
                $message = $client->messages->create(
                    "+251 71 291 1008", // Recipient's phone number
                    [
                        'from' => $twilio_number,
                        'body' => 'Sent From Gion E-Market Customer'. '   '. $user->phone . '      ' . 'For Your Product' . '      '. $product->title .'    '. $message . '   ' . 'Please Contact Me!!'
                    ]
                );

                return redirect()->back()->with('message', "Message Sent Successfully!!");
            }  catch (Exception $exception) {
                return redirect()->back()->with('Failed', 'Failed to send SMS. Please check your internet connection and try again.');
            }
        } else {
            return redirect()->back()->with('Noresult', 'No Message Entered!!');
        }
    }
}
