@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" value="{{ old('name') }}" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" id="email" name="email" value="{{ old('email') }}" />
                        <span class="text-danger">{{ $errors->first('email') }}</span>

                    </div>
                    <div class="form-group">
                        <label for="name">Password</label>
                        <input class="form-control" id="password" name="password" value="{{ old('password') }}" />
                        <span class="text-danger">{{ $errors->first('password') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">role</label>
                        <input class="form-control" id="role" name="role" value="{{ old('role') }}" />
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
