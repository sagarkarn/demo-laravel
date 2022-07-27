@extends('layouts.header')
@section('layout')
    <div>
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('user.create') }}"><i class="fa fa-plus mr-2"> </i>Add new</a>
        </div>
        <table class="table border mt-2">
            <thead>
                <tr>
                    <th>
                        Id
                    </th>
                    <th>
                        Name
                    </th>
                    <th>
                        Email
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a href="{{ route('user.edit', $user->id) }}" class="d-inline btn btn-info" type="button"><i
                                    class="fa fa-edit"></i></a>

                            <form class="d-inline" action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @method('delete')
                                @csrf

                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                            </form>


                        </td>
                    </tr>
                @endforeach
                <tr>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
