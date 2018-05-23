@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                        @include('layouts.message')
                        <a href="{{route('order.add')}}" ><button type="button" class="btn btn-success">Add order</button></a>
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
                                        <a href="{{route('order.view', ['id'=>$order->id])}}" ><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{{route('order.edit', ['id'=>$order->id])}}" ><i class="fa fa-edit"></i></a>
                                        <a href="{{route('order.del', ['id'=>$order->id])}}" ><i class="fa fa-trash"></i></a>
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