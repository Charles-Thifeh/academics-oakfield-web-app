<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Alert;
use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Receipt;
use DB;

class BillsController extends Controller
{
    public function index(){
        $session = DB::table('billoptions')->select('session')->distinct()->get();
        return view('bills.index', ['session' => $session]);
    }

    public function view_invoice(Request $request){
        $session = $request->session;
        $term = $request->term;
        $type = $request->type;
        $class = DB::table("students")->where("id", Auth::id())->first()->class;
        $reg_no = DB::table("students")->where("id", Auth::id())->first()->reg_no;
        $latest_session = DB::table('results')->select('session')->latest()->first()->session;

        if($session == null){
            Alert::error('Select Session', 'select a valid session');
            return redirect()->back();
        }

        if($term == null){
            Alert::error('Select Term', 'select a valid term');
            return redirect()->back();
        }

        if($type == null){
            Alert::error('Select Type', 'select a valid type');
            return redirect()->back();
        }

        if ($type == "schoolfees"){
            $bill = DB::table('billoptions')->where('term', $term)->where('session', $session)->where('class', $class)->first();
            if($bill == null){
                Alert::error('Bill Not Available', 'This bill is not available. See the bursar for more information');
                return redirect()->back();
            }
            $total_bill = $bill->tuition + $bill->others + $bill->pta + $bill->lessonfee + $bill->valedictoryfee;
            $status = 'old';
            $midresult = DB::table('midterm')->where('reg_no', $reg_no)->where('session', $latest_session)->latest();
            $pryresult = DB::table('results')->where('reg_no', $reg_no)->where('session', $latest_session)->latest();
            $secresult = DB::table('pryres')->where('reg_no', $reg_no)->where('session', $latest_session)->latest();
            if($midresult == null && $pryresult == null && $secresult == null){
                $status = 'new';
                $total_bill = $bill->tuition + $bill->others + $bill->pta + $bill->entryfee + $bill->lessonfee + $bill->valedictoryfee;
            }
            $check = DB::table('payments')->where('term', $term)->where('session', $session)->where('reg_no', $reg_no)->first();

            if($check != null){
                $total_bill = $check->payableamount;
            }

            return view('bills.schoolfees.index', [
                'bill' => $bill,
                'check' => $check,
                'status' => $status,
                'class' => $class,
                'total_bill' => $total_bill,
            ]);
        }
        elseif($type == "listofbooks"){
            Alert::success('Pending', 'Feature coming soon');
            return redirect('bills');
            // return view('bills.listofbooks.index');
        }
    }

    public function make_payment_options(Request $request){
        $type = $request->paymenttype;
        $bill_id = $request->bill_id;

        $bill = DB::table('billoptions')->where("id", $bill_id)->first();
        $term = $bill->term;
        $session = $bill->session;
        $class = $bill->class;
        $reg_no = DB::table("students")->where("id", Auth::id())->first()->reg_no;

        $check = DB::table('payments')->where('term', $term)->where('session', $session)->where('reg_no', $reg_no)->first();

        if($check == null){
            Payment::create([
                'reg_no' => $reg_no,
                'class' => $class,
                'term' => $term,
                'session' => $session,
                'type' => 'schoolfees',
                'totalbills' => $request->payable,
                'payableamount' => $request->payable
            ]);
        }

        $payment = DB::table('payments')->where('term', $term)->where('session', $session)->where('reg_no', $reg_no)->first();

        if($type == "paystack"){
            return view("bills.schoolfees.paystack.index", ['payment' => $payment]);
        }elseif($type == "banktransfer"){

        }else{
            Alert::error("Invalid Option", "Select a valid option");
            return redirect()->back();
        }
    }

    public function callback(Request $request)
    {
        //dd($request->all());
        $reference = $request->reference;
        $secret_key = env('PAYSTACK_SECRET_KEY');
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/".$reference,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "Authorization: Bearer $secret_key",
                "Cache-Control: no-cache",
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        $response = json_decode($response);
        //dd($response);
        $meta_data = $response->data->metadata->custom_fields;

        if($response->data->status == 'success')
        {
            if(Transaction::where("reference", $reference)->first() == null){
                $obj = new Transaction;
                $obj->reference = $reference;
                $obj->reg_no = $meta_data[2]->value;
                $obj->details = "via paystack";
                $obj->amount = $response->data->amount / 100;
                $obj->payment_id = $meta_data[0]->value;
                $obj->status = "success";
                $obj->save();

                $payment = Payment::where("id", $meta_data[0]->value)->first();
                $amountpaid = ($response->data->amount / 100) + $payment->amountpaid;

                Payment::where("id", $meta_data[0]->value)
                        ->update([
                            'amountpaid' => $amountpaid
                        ]);

                $id = Transaction::where("reg_no", $meta_data[2]->value)->latest()->get()->first()->id;
                $receiptID = $this->generateUniqueCode();

                $obj = new Receipt;
                $obj->receiptID = $receiptID;
                $obj->reg_no = $meta_data[2]->value;
                $obj->transaction_id = $id;
                $obj->save();

                $receipt = Receipt::where('receiptID', $receiptID)->first();
                $transaction = Transaction::where('id', $receipt->transaction_id)->first();
                $payment = Payment::where("id", $meta_data[0]->value)->first();

                toast('Your transaction was successful!','success');
                return view('bills.receipt', ['receipt' => $receipt, 'transaction' => $transaction, 'payment' => $payment]);
            }
            $payment = Payment::where("id", $meta_data[0]->value)->first();
            $transaction = Transaction::where("reg_no", $meta_data[2]->value)->latest()->get()->first();
            $receipt = Receipt::where("transaction_id", $transaction->id)->first();

            toast('This transaction has been made!','error');
            return view('bills.receipt', ['receipt' => $receipt, 'transaction' => $transaction, 'payment' => $payment]);


        } else {
            $obj = new Transaction;
            $obj->reference = $reference;
            $obj->reg_no = $meta_data[2]->value;
            $obj->details = "via paystack";
            $obj->amount = $response->data->amount / 100;
            $obj->payment_type = $meta_data[0]->value;
            $obj->status = "failed";
            $obj->save();
            Alert::error("Failed", "Transaction Failed. try another payment method");
        }
    }

    public function generateUniqueCode(){
        do {
            $code = random_int(10000000, 99999999);
        } while (Receipt::where("receiptID", "=", $code)->first());
        return $code;
    }
}
