@extends('layouts.header')
@section('layout')
    <div class="col-sm-6 ">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('user.update', $user->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control" id="name" name="name" value="{{ $user->name }}" />
                        <span class="text-danger">{{ $errors->first('name') }}</span>
                    </div>
                    <div class="form-group">
                        <label for="name">Email</label>
                        <input class="form-control" id="email" name="email" value="{{ $user->email }}" />
                        <span class="text-danger">{{ $errors->first('email') }}</span>
                    </div>

                    <div class="form-group">
                        <label for="name">role</label>
                        <input class="form-control" id="role" name="role" />
                        <span class="text-danger">{{ $errors->first('role') }}</span>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    </div>
@endsection
