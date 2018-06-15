@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр заказа</h3>
                <div style="clear: both"></div>
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>№</td><td>{{ $order->id }}</td>
                    </tr>
                    <tr>
                        <td>Тип заявки</td><td>{{ $order->typeWork->name }}</td>
                    </tr>
                    <tr>
                        <td>Заказчик фирма</td><td>{{ $order->firm->name }}</td>
                    </tr>
                    @if($order->client)
                    <tr>
                        <td>Заказчик филиал</td><td>{{ $order->client->name }}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Подрядчик</td><td>{{ $order->contractor->name }}</td>
                    </tr>
                    <tr>
                        <td>Дата выполнения</td><td>{{ $order->date_end }}</td>
                    </tr>
                    @if($user->is_admin() || $user->is_contractor())
                        <tr>
                            <td>Акт выполненных работ</td>
                            <td>
                                <a href="#" data-toggle="modal" data-target="#myModal">
                                    <img src="{{ $order->act_complete }}" style="width: 100px; height: 150px;">
                                </a>
                            </td>
                        </tr>
                    @endif
                    <tr>
                        <td>Комментарий</td><td>{{ $order->comment }}</td>
                    </tr>
                    <tr>
                        <td>Статус</td><td>{{ $order->status->name }}</td>
                    </tr>
                    <tr>
                        <td>Дата создания</td><td>{{ $order->created_at }}</td>
                    </tr>
                    </tbody>
                </table>
                <a href="{{route('order.edit', $order->id)}}" ><button type="button" class="btn btn-success">Редактировать</button></a>
                <a href="{{route('orders')}}" ><button type="button" class="btn btn-success">Все заявки</button></a>

            </div>
        </div>
    </div>
    @if($user->is_admin() || $user->is_contractor())
        <div id="myModal" class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header"><button class="close" type="button" data-dismiss="modal">×</button>
                        <h4 class="modal-title">Заголовок окна</h4>
                    </div>
                    <div class="modal-body"><img src="{{ $order->act_complete }}"></div>
                    <div class="modal-footer"><button class="btn btn-default" type="button" data-dismiss="modal">Закрыть</button></div>
                </div>
            </div>
        </div>
    @endif
@endsection