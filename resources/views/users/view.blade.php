@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр пользователя</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Логин</td>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <td>E-Mail</td>
                        <td>{{ $user->email }}</td>
                    </tr>
                    <tr>
                        <td>Тип пользователя</td>
                        <td>{{ $user->profile->role->name }}</td>
                    </tr>
                    <tr>
                        <td>ФИО</td>
                        <td>{{ $user->profile->name }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $user->profile->phone }}</td>
                    </tr>
                    @if($user->is_admin_firm() || $user->is_client())
                    @if($user->profile->firm)
                        <tr>
                            <td>Организация</td>
                            <td>{{ $user->profile->firm->name }}</td>
                        </tr>
                    @endif
                    @if($user->profile->client)
                        <tr>
                            <td>Филиал</td>
                            <td>{{ $user->profile->client->name }}</td>
                        </tr>
                    @endif
                    @endif
                    @if($user->is_contractor())
                        <tr>
                            <td>Организация</td>
                            <td>{{ $user->profile->contractor->name }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td>Статус</td>
                        <td>{{ $user->profile->status }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $user->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('user.edit', $user->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('users')}}">
                    <button type="button" class="btn btn-success">Все пользователи</button>
                </a>

            </div>
        </div>
    </div>
@endsection