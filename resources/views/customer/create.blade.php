@extends('layouts.master')

@section('content')
<div class="box">
    <div class="box-header">
        <h5>Customer Create</h5>
        <a href="{{ route('customer.list') }}"  class="btn btn-success">Customer List</a>
    </div>
    <div class="box-body">
        <div class="row">
            <div class="col-md-6 offset-3">
                <form action="{{ route('customer.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                        @if($errors->first('name'))
                            <span class="text-danger">{{ $errors->first('name') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input type="email" name="email" class="form-control"  value="{{ old('email') }}">
                        @if($errors->first('email'))
                            <span class="text-danger">{{ $errors->first('email') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" name="phone" class="form-control"  value="{{ old('phone') }}">
                        @if($errors->first('phone'))
                            <span class="text-danger">{{ $errors->first('phone') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male</option>
                            <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>Female</option>
                            <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @if($errors->first('gender'))
                            <span class="text-danger">{{ $errors->first('gender') }}</span>
                        @endif
                    </div>            
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="status">
                            Active
                        </label>
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label><br>
                        <input type="file" name="photo">
                        @if($errors->first('photo'))
                            <span class="text-danger">{{ $errors->first('photo') }}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="box-footer"></div>
</div>
@endsection