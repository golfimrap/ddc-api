@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            Add User
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('user.store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email">
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="mb-3">
                    <label class="form-label">ชื่อ</label>
                    <input type="text" class="form-control" name="name" id="name">
                </div>
                <input type="submit" value="Register" class="btn btn-primary">
            </form>
        </div>
    </div>
@endsection
