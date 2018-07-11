@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр населенного пункта</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Регион</td>
                        <td>{{ $city->region->name }}</td>
                    </tr>
                    <tr>
                        <td>Название</td>
                        <td>{{ $city->name }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('cites.edit', $city->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('cites.index')}}">
                    <button type="button" class="btn btn-success">Все Населенные пункты</button>
                </a>

            </div>
        </div>
    </div>
@endsection