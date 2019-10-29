@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Создание нового заказа</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal" action="{{ route('order.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Тип услуги<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select id="type_work" name="type_work" class="form-control">
                                @foreach($order->typeWorks() as $type)
                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    @if($user->is_client() && isset($user->profile->client->printers) && count($user->profile->client->printers) > 0)
                       <!-- <div class="form-group">
                            <label class="col-md-3 control-label">Принтер</label>
                            <div class="col-md-9">
                                <select id="printer_order" name="printer" class="form-control" required>
                                    <option value="">Выберите принтер</option>
                                    @foreach($user->profile->client->printers as $printer)
                                        <option value="{{ $printer->id }}">{{ $printer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                       <div id="block_regenerate">
                           <div id="cartridge_list"></div>
                       </div>-->
                    @endif
                    <div id="order_printers">
                        <!--<div class="form-group">
                            <label class="col-md-3 control-label">Принтер</label>
                            <div class="col-md-9">
                                <select id="printer_order" name="printer[]" class="form-control select_printer" required>
                                    <option value="">Выберите принтер</option>
                                    @foreach($user->profile->client->printers as $printer)
                                        <option value="{{ $printer->id }}">{{ $printer->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>-->
                    </div>
                    <div class="form-group">
                    <button id="add_order_printer" type="button" class="btn btn-default" style="float: right">
                        <i class="fa fa-plus-circle"></i> принтер
                    </button>
                    </div>
                    <div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">дата выполнения <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="date" name="date_end" value="{{old('date_end', null)}}">
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
                            <textarea class="form-control" name="comment">{{old('comment', null)}}</textarea>
                        </div>
                    </div>
                    @if($user->is_admin() || $user->is_contractor())
                    <div class="form-group">
                        <label class="col-md-3 control-label">Status<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="status" class="form-control">
                                @foreach($order->statuses() as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
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