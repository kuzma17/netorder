@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр офиса</h3>
                <div style="clear: both"></div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#main">Основные данные</a></li>
                    @if(count($client->printers) > 0)
                        <li><a data-toggle="tab" href="#equipment">Принтеры</a></li>
                    @endif
                </ul>
                <div class="tab-content">
                    <div id="main" class="tab-pane fade in active">
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
                                <td>{{ $client->city->name }}</td>
                            </tr>
                            <tr>
                                <td>Название</td>
                                <td>{{ $client->name }}</td>
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
                    @if(count($client->printers) > 0)
                        <div id="equipment" class="tab-pane fade">
                            <h4>Принтеры</h4>
                            <div style="clear: both"></div>
                            <table class="table table-responsive">
                                <tbody>
                                @foreach($client->printers as $printer)
                                    <tr>
                                        <td><strong>{{ $printer->name }}</strong>
                                            @if(count($printer->cartridges) > 0)
                                                <table class="table table-bordered">
                                                @foreach($printer->cartridges as $cartridge)
                                                    <tr>
                                                        <td>картридж</td>
                                                        <td>{{$cartridge->name}}</td>
                                                        <td>{{$client->price($printer->id, $cartridge->id)->price or ''}}</td>
                                                        <td>{{$client->price($printer->id, $cartridge->id)->price2 or ''}}</td>
                                                    </tr>
                                                @endforeach
                                                </table>
                                             @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="{{route('client.edit', $client->id)}}">
                                <button type="button" class="btn btn-success">Редактировать</button>
                            </a>
                            <a href="{{route('firms')}}">
                                <button type="button" class="btn btn-success">Все клиенты</button>
                            </a>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
@endsection