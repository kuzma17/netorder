@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование офиса</h3>
                <div style="clear: both"></div>

                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#main">Основные данные</a></li>
                    <li><a data-toggle="tab" href="#equipment">Принтеры</a></li>
                </ul>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal"
                      action="{{ route('client.edit', ['id'=>$client->id]) }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="firm" value="{{$client->firm_id}}">

                    <div class="tab-content">
                        <div id="main" class="tab-pane fade in active">
                            <h4>Основные данные</h4>
                            <div style="clear: both"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Регион<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="region" class="form-control">
                                        @foreach($client->list_regions() as $region)
                                            <option value="{{ $region->id }}"
                                                    @if($client->region_id == $region->id) selected @endif>{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Город, населенный пункт<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="town" class="form-control">
                                        @foreach($client->list_towns() as $town)
                                            <option value="{{ $town->id }}"
                                                    @if($client->town_id == $town->id) selected @endif>{{ $town->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Подрядчик <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="contractor" class="form-control">
                                        <!--<option value="0">Выберите подрядчика</option>-->
                                        @foreach($client->list_contractors() as $contractor)
                                            <option value="{{ $contractor->id }}"
                                                    @if($client->contractor_id == $contractor->id) selected @endif>{{ $contractor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Название<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="name"
                                           value="{{old('name', $client->name)}}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Телефон <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="phone"
                                           value="{{old('phone', $client->phone)}}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Адрес <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="address"
                                           value="{{old('address', $client->address)}}">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Статус</label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="off" @if($client->status == 'off') selected @endif>off</option>
                                        <option value="on" @if($client->status == 'on') selected @endif>on</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary" name="add_all_order" value="Сохранить">
                                </div>
                            </div>
                        </div>
                        <div id="equipment" class="tab-pane fade">
                            <h4>Принтеры</h4>
                            <div style="clear: both"></div>
                            <div id="equipment_list">
                                @foreach($client->printers as $printer)
                                    <div class="printer">
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Модель принтера</label>
                                        <div class="col-md-8">
                                            <select class="form-control select_printer" name="printer[]" required>
                                                @foreach($allPrinters as $print)
                                                    <option value="{{$print->id}}" @if($print->id == $printer->id) selected @endif>{{$print->name}}</option>';
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-1">
                                            <a href="#" class="equipment_del" title="Удалить принтер"><i class="fa fa-trash red"></i></a>
                                        </div>
                                    </div>
                                        <div class="regenerate">
                                            @foreach($printer->cartridges as $cartridge)
                                                <div class="row cartridge">
                                                    <label class="col-md-3 control-label">Картридж/Стоимость</label>
                                                    <div class="col-md-4">
                                                        <input type="hidden" name="cartridge[{{$printer->id}}][]" value="{{$cartridge->id}}">
                                                        <div class="cartridge_model">{{$cartridge->name}}</div></div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" type="text"
                                                               name="price[{{$printer->id}}][{{$cartridge->id}}]]"
                                                               value="{{$client->price($printer->id, $cartridge->id)->price or ''}}" required>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input class="form-control" type="text"
                                                               name="price2[{{$printer->id}}][{{$cartridge->id}}]]"
                                                               value="{{$client->price($printer->id, $cartridge->id)->price2 or ''}}" required>
                                                    </div>
                                                </div>
                                             @endforeach
                                        </div>
                                        <div class="row">
                                            <div class="col-md-7"></div>
                                            <div class="col-md-2"><p class="small">заправка</p></div>
                                            <div class="col-md-2"><p class="small">восстановление</p></div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button id="equipment_add" type="button" class="btn btn-default" style="float: right">
                                <i class="fa fa-plus-circle"></i> принтер
                            </button>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary" name="add_all_order" value="Сохранить">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection