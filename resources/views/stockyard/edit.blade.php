@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('stockyard.update', $stockyard->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Stock Yard Name</label>
                        <input class="form-control" id="name" name="name" value="{{ $stockyard->name }}" />
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
