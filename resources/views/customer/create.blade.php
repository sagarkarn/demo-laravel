@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('customer.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Full Name</label>
                        <input class="form-control" id="name" name="name" />
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="number" class="form-control" id="name" name="phone" />
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" name="email" />
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input class="form-control" id="address" name="address" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
