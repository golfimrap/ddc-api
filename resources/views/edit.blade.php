@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            Add User
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.update', $data_users['id']) }}">
                @csrf
                @method('patch')
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" value="{{ $data_users['email'] }}" id="email" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" name="name"  value="{{ $data_users['name'] }}" id="name">
                </div>
                <input type="submit" value="Edit" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
