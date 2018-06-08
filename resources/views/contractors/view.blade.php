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
                        <td>Организация подрядчик</td>
                        <td>{{ $contractor->name }}</td>
                    </tr>
                    <tr>
                        <td>Ответственное лицо</td>
                        <td>{{ $contractor->user->name }}</td>
                    </tr>
                    <tr>
                        <td>Телефон</td>
                        <td>{{ $contractor->phone }}</td>
                    </tr>
                    <tr>
                        <td>Адрес</td>
                        <td>{{ $contractor->address }}</td>
                    </tr>
                    <tr>
                        <td>Статус</td>
                        <td>{{ $contractor->status }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td>
                        <td>{{ $contractor->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('contractor.edit', $contractor->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('contractors')}}">
                    <button type="button" class="btn btn-success">Все подрядчики</button>
                </a>

            </div>
        </div>
    </div>
@endsection