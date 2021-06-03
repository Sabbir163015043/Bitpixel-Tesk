@extends('layouts.master')

@section('content')
<div class="box">
    <div class="box-header">
        <h5>Customer List</h5>
        <a href="{{ route('customer.create') }}" class="btn btn-success">Add Customer</a>
    </div>
    <div class="box-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Gender</th>
                    <th>Photo</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if($customers->isNotEmpty())
                    @foreach ($customers as $key => $customer)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $customer->name }}</td>
                            <td>{{ $customer->email }}</td>
                            <td>{{ $customer->phone }}</td>
                            <td>{{ $customer->gender }}</td>
                            <td>
                                @if($customer->photo)
                                    <img src="{{ asset($customer->photo) }}" alt="" width="80">
                                @endif
                            </td>
                            <td>{!! $customer->is_active ? '<span class="badge badge-success">Active</span>' :  '<span class="badge badge-warning">Inactive</span>' !!}</td>
                            <td>
                                <a class="btn btn-sm btn-primary" href="{{ route('customer.edit', $customer->id) }}">Edit</a>
                                <form action="{{ route('customer.delete', $customer->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else 
                    <tr>
                        <td colspan="8">No Customer Found</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="box-footer"></div>
</div>
@endsection