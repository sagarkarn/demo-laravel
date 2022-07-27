@extends('layouts.header')
@section('layout')
    <div>
        <div class="text-right">
            <a class="btn btn-primary" href="{{ route('customer.create') }}"><i class="fa fa-plus mr-2"> </i>Add new</a>
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
                        Contact
                    </th>
                    <th>
                        Address
                    </th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
                    <tr>
                        <td>{{ $customer->id }}</td>
                        <td>{{ $customer->name }}</td>
                        <td>
                            <div class="text-center">{{ $customer->phone }}<br /><span
                                    class="badge badge-pill badge-secondary">{{ $customer->email }}</span></div>
                        </td>
                        <td>{{ $customer->address }}</td>

                        <td>
                            <a href="{{ route('customer.edit', $customer->id) }}" class="d-inline btn btn-info"
                                type="button"><i class="fa fa-edit"></i></a>

                            <form class="d-inline" action="{{ route('customer.destroy', $customer->id) }}" method="POST">
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
