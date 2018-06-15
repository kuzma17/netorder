@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filter">
                    <form name="filter" method="post" class="form-horizontal" action="{{ route('orders.filter') }}">
                        {{ csrf_field() }}
                        <div class="col-md-6 form-group">
                            <label class="col-md-3 control-label">Дата создания от</label>
                            <div class="col-md-9 input-group-sm">
                                <input type="text" name="date_from" class="form-control"
                                       value="{{ Request::get('date_from')}}">
                            </div>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="col-md-3 control-label">Дата создания до</label>
                            <div class="col-md-9 input-group-sm">
                                <input type="text" name="date_to" class="form-control"
                                       value="{{ Request::get('date_to')}}">
                            </div>
                        </div>
                        @can('filter', \App\User::class)
                            <div class="col-md-6 form-group" id="firm">
                                <label class="col-md-3 control-label">Фирма</label>
                                <div class="col-md-9 input-group-sm">
                                    <select name="firm" id="firm" class="form-control">
                                        <option value="0">-</option>
                                        @foreach($firms as $firm)
                                            <option value="{{ $firm->id }}"
                                                    @if(Request::get('firm') == $firm->id) selected @endif>{{ $firm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
                        @can('filter_branch', \App\User::class)
                            <div class="col-md-6 form-group" id="branch">
                                <label class="col-md-3 control-label">Филиал</label>
                                <div class="col-md-9 input-group-sm">
                                    <select name="branch" id="branch" class="form-control">
                                        <option value="0">-</option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}"
                                                    @if(Request::get('branch') == $client->id) selected @endif>{{ $client->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
                        @can('filter', \App\User::class)
                            <div class="col-md-6 form-group">
                                <label class="col-md-3 control-label">Подрядчик</label>
                                <div class="col-md-9 input-group-sm">
                                    <select name="contractor" id="contractor" class="form-control">
                                        <option value="0">-</option>
                                        @foreach($contractors as $contractor)
                                            <option value="{{ $contractor->id }}"
                                                    @if(Request::get('contractor') == $contractor->id) selected @endif>{{ $contractor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endcan
                        <div class="col-md-6 form-group">
                            <label class="col-md-3 control-label">Статус</label>
                            <div class="col-md-9 input-group-sm">
                                <select name="status" id="status" class="form-control">
                                    <option value="0">-</option>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}"
                                                @if(Request::get('status') == $status->id) selected @endif>{{ $status->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <button id="submit_filter" type="submit" class="btn btn-primary btn-sm"
                                    style="float: right">выбрать
                            </button>
                            <button id="reset_filter" type="button" class="btn btn-default btn-sm"
                                    style="float: right; margin-right: 5px">reset
                            </button>
                        </div>
                        <div style="clear: both"></div>
                    </form>
                </div>
                <div class="filter_btn">
                    <i class="fa fa-filter" aria-hidden="true"></i> filter <i class="fa fa-caret-up down"
                                                                              aria-hidden="true"></i>
                </div>

                <div class="info">
                    <i class="fa fa-files-o" aria-hidden="true"></i> заказов <span class="label label-danger">новых: {{ $countWaitOrder }}</span>
                    <span class="label label-success">в работе: {{ $countWorkOrder }}</span>
                    <span class="label label-primary">всего: {{ $countAllOrder }}</span>
                </div>

                @include('layouts.message')
                @can('add', \App\Order::class)
                    <a href="{{route('order.add')}}">
                        <button type="button" class="btn btn-success ">Создать заказ</button>
                    </a>
                @endcan
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Тип</th>
                        <th>Дата выполнения</th>
                        <th>Комментарий</th>
                        <th>Статус</th>
                        <th>время созд./изм.</th>
                        <th>test</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        <tr class="list-group-item-{{$order->status->style}}">
                            <td>{{$order->id}}</td>
                            <td>{{$order->typeWork->name}}</td>
                            <td>{{ date('Y.m.d', strtotime($order->date_end))}}</td>
                            <td>{{$order->comment}}</td>
                            <td><span class="label label-{{$order->status->style}}">{{$order->status->name}}</span></td>
                            <td>{{ date("Y.m.d h:i", strtotime($order->updated_at)) }}</td>
                            <td>f:{{$order->firm_id}} b:{{$order->client_id}} c:{{$order->contractor_id}}</td>
                            <td>
                                <a title="Просмотр заказа" href="{{route('order.view', ['id'=>$order->id])}}"><i
                                            class="fa fa-eye" aria-hidden="true"></i></a>
                                @can('edit', $order)
                                    <a title="Редактировать заказ" href="{{route('order.edit', ['id'=>$order->id])}}"><i
                                                class="fa fa-edit"></i></a>
                                @endcan
                                @can('del', $order)
                                    <a class="del" title="Удалить заказ" href="{{route('order.del', ['id'=>$order->id])}}"><i
                                                class="fa fa-trash"></i></a>
                                @endcan
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>

                {!! $orders->render() !!}
            </div>
        </div>
    </div>
@endsection