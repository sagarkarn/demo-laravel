@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.update', $customer->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" value="{{ $customer->name }}" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email"
                            value="{{ $customer->email }}" />
                    </div>

                    <div class="form-group">
                        <label for="phone">Mobile No.</label>
                        <input type="number" class="form-control" id="phone" name="phone"
                            value="{{ $customer->phone }}" />
                    </div>

                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" id="address" name="address" value="{{ $customer->address }}" />
                    </div>


                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
