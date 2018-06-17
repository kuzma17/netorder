@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование заказа</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal"
                      action="{{ route('order.edit', ['id'=>$order->id]) }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Тип услуги<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="type_work" class="form-control" @if($user->is_contractor()) disabled @endif>
                                @foreach($order->typeWorks() as $type)
                                    <option value="{{ $type->id }}"
                                            @if($type->id == $order->typeWork->id) selected="selected" @endif>{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if(($user->is_client() || $user->is_admin()) && \App\Equipment::where('client_id', $order->client_id)->count() > 0)
                        <div class="form-group">
                            <label class="col-md-3 control-label">Оборудование</label>
                            <div class="col-md-9">
                                <select name="equipment" class="form-control">
                                    @foreach(\App\Equipment::where('client_id', $order->client_id)->get() as $equipment)
                                        <option value="{{ $equipment->name }}">{{ $equipment->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                    <div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">дата выполнения</label>
                        <div class="col-md-9">
                            <input class="form-control" type="date" name="date_end"
                                   value="{{old('date_end', $order->date_end)}}"  @if($user->is_contractor()) readonly @endif>
                            @if ($errors->has('date_end'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Комментарий</label>
                        <div class="col-md-9">
                            <textarea class="form-control" name="comment"  @if($user->is_contractor()) disabled @endif>{{old('comment', $order->comment)}}</textarea>
                        </div>
                    </div>
                    @if($user->is_admin() || $user->is_contractor())
                    <div class="form-group">
                        <div class="ajax-respond col-md-12 control-label">
                            <img src="{{$order->act_complete or ''}}" style="width:200px;height:200px">
                            <input type="hidden" name="act_complete" id="act_complete" value="{{$order->act_complete or ''}}">
                            <div style="clear: both"></div>
                        </div>
                        <label class="col-md-3 control-label">Акт</label>
                        <div class="col-md-9">
                            <input type="file" class="form-control" name="act" id="act" multiple="multiple">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Статус</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control"  @if($user->is_client()) disabled @endif>
                                @foreach($order->statuses() as $status)
                                    <option value="{{ $status->id }}"
                                            @if($status->id == $order->status->id) selected="selected" @endif>{{ $status->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col-md-9">
                            <input type="submit" class="btn btn-primary" name="add_all_order" value="Сохранить">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection