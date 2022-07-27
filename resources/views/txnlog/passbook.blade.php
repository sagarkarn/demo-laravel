@extends('layouts.header')
@section('layout')
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Passbook</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Employee</th>
                            <th>type</th>
                            <th>sub type</th>
                            <th>bill no</th>
                            <th>bill amount</th>
                            <th>order id</th>
                            <th>product id</th>
                            <th>quantity</th>
                            <th>remarks</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($txnLogs as $txnlog)
                            <tr>
                                <td>{{ $txnlog->id }}</td>
                                <td>{{ $txnlog->employee->name }}</td>
                                <td>{{ $txnlog->type }}</td>
                                <td>{{ $txnlog->sub_type }}</td>
                                <td>{{ $txnlog->bill_no }}</td>
                                <td>{{ $txnlog->bill_amount }}</td>
                                <td>{{ $txnlog->order_id }}</td>
                                <td>{{ $txnlog->product_id }}</td>
                                <td>{{ $txnlog->quantity }}</td>
                                <td>{{ $txnlog->remarks }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
