@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        @include('layouts.message')
                        @can('add', \App\User::class)
                            <a href="{{route('user.add')}}" >
                                <button type="button" class="btn btn-success">Add user</button>
                            </a>
                        @endcan
                    <table class="table">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Имя</th>
                            <th>email</th>
                            <th>Телефон</th>
                            <th>Тип</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->profile->phone}}</td>
                                <td>@foreach($user->roles as $role) {{ $role->name.' ' }} @endforeach</td>
                                <td>
                                    <a href="{{route('user.edit', ['id'=>$user->id])}}" ><i class="fa fa-edit"></i></a>
                                    <a href="{{route('user.del', ['id'=>$user->id])}}" ><i class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        <tbody>
                        </tbody>
                    </table>

                        {!! $users->render() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection