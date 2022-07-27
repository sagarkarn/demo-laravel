@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('product.update', $product->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Product Name</label>
                        <input class="form-control" id="name" name="name" value="{{ $product->name }}" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" step="0.01" class="form-control" id="price" name="price"
                            value="{{ $product->price }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
