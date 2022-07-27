<?php

namespace App\Http\Controllers;

use App\Http\Requests\InwardEntryStoreRequest;
use App\Models\Product;
use App\Models\TxnLog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TxnLogController extends Controller
{
    public function inwardEntry()
    {
        $products = Product::all();
        $employees = User::all();
        return view('txnlog.inwardEntry', compact('products', 'employees'));
    }
    /**
     * Store a newly created inward entry in database.
     *
     * @param  InwardEntryStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function inwardEntryStore(InwardEntryStoreRequest $request)
    {
        $data = $request->validated();
        $txnLogs = array();
        foreach ($data['products'] as $key => $value) {
            $txnLog = new TxnLog();
            $txnLog->product_id = @$data['products'][$key];
            $txnLog->employee_id = @$data['employee'];
            $txnLog->quantity = $data['quantity'][$key];
            $txnLog->type = 'IN';
            $txnLog->user_id = Auth::id();
            $txnLog->sub_type = @$data['from'];
            $txnLog->bill_no = @$request->input('bill_no');
            $txnLog->bill_amount = @$data['bill_amount'];
            $txnLogs[] = $txnLog;
            $txnLog->save();
        }
        return back();
    }

    public function passbook()
    {
        $txnLogs = TxnLog::where('user_id', Auth::id())->get();
        return view('txnlog.passbook', compact('txnLogs'));
    }
}
