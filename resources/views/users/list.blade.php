@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                        @include('layouts.message')
                        @can('add', \App\User::class)
                            <a href="{{route('user.add')}}" >
                                <button type="button" class="btn btn-success">Создать пользователя</button>
                            </a>
                        @endcan
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>Имя</th>
                            <th>email</th>
                            <th>Телефон</th>
                            <th>Тип</th>
                            <th>Фирма</th>
                            <th>Статус</th>
                            <th></th>
                        </tr>
                        </thead>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->profile->phone or ''}}</td>
                                <td>{{$user->profile->role->name}}</td>
                                <td>
                                    @if($user->is_admin_firm() || $user->is_client())
                                        {{$user->profile->firm->name}}
                                    @elseif($user->is_contractor())
                                        {{$user->profile->contractor->name}}
                                    @else
                                        {{ '' }}
                                    @endif
                                </td>
                                <td>{{$user->profile->status}}</td>
                                <td>
                                    <a title="Просмотр пользователя" href="{{route('user.view', ['id'=>$user->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <a title="Редактировать пользователя" href="{{route('user.edit', ['id'=>$user->id])}}" ><i class="fa fa-edit"></i></a>
                                    <a title="Изменить пароль" href="{{route('user.passwd.edit', ['id'=>$user->id])}}" ><i class="fa fa-key" aria-hidden="true"></i></a>
                                    <a title="Удалить пользователя" href="{{route('user.del', ['id'=>$user->id])}}" ><i class="fa fa-trash"></i></a>
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
@endsection