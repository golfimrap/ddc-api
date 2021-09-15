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
                        <th scope="col">Emails</th>
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
                                <button class="btn btn-warning" style="display: inline;"><a href="{{ route('user.edit',$value_users['id']) }}" style="text-decoration:none; color:white;">Edit User</a></button>
                                <form method="POST" action="{{ route('user.destroy',$value_users['id']) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-danger" value="Delete User" >
                                </form>
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
