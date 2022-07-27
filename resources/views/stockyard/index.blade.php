@extends('layouts.header')
@section('layout')
    <div>
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('stockyard.create') }}"><i class="fa fa-plus mr-2"> </i>Add new</a>
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
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($stockyards as $stockyard)
                    <tr>
                        <td>{{ $stockyard->id }}</td>
                        <td>{{ $stockyard->name }}</td>
                        <td>
                            <a href="{{ route('stockyard.edit', $stockyard->id) }}" class="d-inline btn btn-info"
                                type="button"><i class="fa fa-edit"></i></a>

                            <form class="d-inline" action="{{ route('stockyard.destroy', $stockyard->id) }}"
                                method="POST">
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
