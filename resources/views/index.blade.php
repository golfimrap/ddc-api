@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-header text-center">
            Users
          </div>
        <div class="card-body">
            <a href="{{ route('user.create') }}" class="btn btn-primary">Add User</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">ชื่อ</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i=1;
                    @endphp
                    @foreach ($data_users as $value_users)
                        <tr>
                            <td>{{ $i }}</td>
                            <td>{{ $value_users['email'] }}</td>
                            <td>{{ $value_users['name'] }}</td>
                            <td>
                                <a href="{{ route('user.edit',$value_users['id']) }}" class="btn btn-warning">Edit User</a>
                            </td>
                        </tr>
                        @php
                            $i++;
                        @endphp
                    @endforeach
                </tbody>
              </table>
        </div>
    </div>
@endsection
