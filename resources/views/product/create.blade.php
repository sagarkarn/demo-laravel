@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input class="form-control" id="name" name="name" />
                    </div>
                    <div class="form-group">
                        <label for="price">price</label>
                        <input class="form-control" type="number" step="0.01" id="price" name="price" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
