<?php



namespace App\Http\Controllers;



use Illuminate\Http\Request;

use Session;
use Stripe;
use App\Shipping;




class StripePaymentController extends Controller

{

    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripe()

    {

        return view('stripe');

    }



    /**

     * success response method.

     *

     * @return \Illuminate\Http\Response

     */

    public function stripePost(Request $request)

    {

        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        $total=$request->total;
        $shipping_id=$request->shipping_id;
        Stripe\Charge::create ([
                "amount" => 100 * $total,

                "currency" => "usd",

                "source" => $request->stripeToken,

                "description" => "Our Payment description."

        ]);

        Shipping::find($shipping_id)->update([
          'payment_status'=>2
        ]);


        Session::flash('success', 'Payment successful!');



        return redirect('cart');

    }

}
