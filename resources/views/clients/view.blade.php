@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр филиала</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Организация</td>
                        <td>{{ $client->firm->name }}</td>
                    </tr>
                    <tr>
                        <td>Регион</td>
                        <td>{{ $client->region->name }}</td>
                    </tr>
                    <tr>
                        <td>Город, населенный пункт</td>
                        <td>{{ $client->town->name }}</td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{ $client->name }}</td>
                    </tr>
                    <tr>
                        <td>Ответственное лицо, менеджер</td>
                        <td>{{ $client->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $client->phone }}</td>
                    </tr>
                    <tr>
                        <td>Адрес</td>
                        <td>{{ $client->address }}</td>
                    </tr>
                    <tr>
                        <td>Статус</td>
                        <td>{{ $client->status }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $client->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('client.edit', $client->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('firms')}}">
                    <button type="button" class="btn btn-success">Все клиенты</button>
                </a>

            </div>
        </div>
    </div>
@endsection