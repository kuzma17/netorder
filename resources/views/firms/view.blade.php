@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр организации</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Название</td>
                        <td>{{ $firm->name }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $firm->phone }}</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>{{ $ашкь->email }}</td>
                    </tr>
                    <tr>
                        <td>Статус</td>
                        <td>{{ $firm->status }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $firm->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('firm.edit', $firm->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('firms')}}">
                    <button type="button" class="btn btn-success">Все клиенты</button>
                </a>

            </div>
        </div>
    </div>
@endsection