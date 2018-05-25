@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.message')
                <div class="filter" style="border: 1px solid #CCCCCC; padding-top: 10px; margin-top: -20px; border-radius: 5px; background-color: #e6eeff">
                    <form name="filter" method="post" class="form-horizontal" action="" >
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Дата создания</label>
                        <div class="col-md-9">
                            <input type="text" name="created_at" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Дата изменения</label>
                        <div class="col-md-9">
                            <input type="text" name="updated_at" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Фирма</label>
                        <div class="col-md-9">
                            <select name="firm" class="form-control">
                                @foreach(\App\Firm::all() as $firm)
                                    <option value="{{ $firm->id }}" >{{ $firm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Филиал</label>
                        <div class="col-md-9">
                            <select name="client" class="form-control">
                                @foreach(\App\Client::all() as $client)
                                    <option value="{{ $client->id }}" >{{ $client->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Подрядчик</label>
                        <div class="col-md-9">
                            <select name="contractor" class="form-control">
                                @foreach(\App\Contractor::all() as $contractor)
                                    <option value="{{ $contractor->id }}" >{{ $contractor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 form-group">
                        <label  class="col-md-3 control-label">Статус</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control">
                                @foreach(\App\Status::all() as $status)
                                    <option value="{{ $status->id }}" >{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <div class="col-md-12 form-group">
                            <input type="submit" value="выбрать" style="float: right">
                        </div>
                        <div style="clear: both"></div>
                    </form>
                </div>
                <a href="{{route('order.add')}}">
                    <button type="button" class="btn btn-success">Add order</button>
                </a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Тип</th>
                        <th>Дата</th>
                        <th>Комментарий</th>
                        <th>Статус</th>
                        <th>Дата создания</th>
                        <th>Дата изм.</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td>{{$order->typeWork->name}}</td>
                            <td>{{ date('d.m.Y', strtotime($order->date_end))}}</td>
                            <td>{{$order->comment}}</td>
                            <td>{{$order->status->name}}</td>
                            <td>{{$order->created_at}}</td>
                            <td>{{$order->updated_at}}</td>
                            <td>
                                <a href="{{route('order.view', ['id'=>$order->id])}}"><i class="fa fa-eye"
                                                                                         aria-hidden="true"></i></a>
                                <a href="{{route('order.edit', ['id'=>$order->id])}}"><i class="fa fa-edit"></i></a>
                                <a href="{{route('order.del', ['id'=>$order->id])}}"><i class="fa fa-trash"></i></a>
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