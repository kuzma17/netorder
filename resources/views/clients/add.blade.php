@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Создание нового филиала</h3>
                <div style="clear: both"></div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" href="#main">Основные данные</a></li>
                    <li><a data-toggle="tab" href="#equipment">Оборудование</a></li>
                </ul>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>
                <form name="order_order" method="post" class="form-horizontal" action="{{ route('client.add') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="firm" value="{{Request::get('firm')}}">
                    <div class="tab-content">
                        <div id="main" class="tab-pane fade in active">
                            <h4>Основные данные</h4>
                            <div style="clear: both"></div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Регион<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="region" class="form-control">
                                        <option value="0">Выберите регион</option>
                                        @foreach($client->list_regions() as $region)
                                            <option value="{{ $region->id }}">{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Город, населенный пункт<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="town" class="form-control">
                                        <option value="0">Выберите город, населенный пункт</option>
                                        @foreach($client->list_towns() as $town)
                                            <option value="{{ $town->id }}">{{ $town->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">Подрядчик <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="contractor" class="form-control">
                                        <option value="0">Выберите подрядчика</option>
                                        @foreach($client->list_contractors() as $contractor)
                                            <option value="{{ $contractor->id }}">{{ $contractor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label">User<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="user" class="form-control">
                                        <option value="0">Выберите пользователя</option>
                                        @foreach($client->list_users() as $user)
                                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label class="col-md-3 control-label">Name<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="name" value="{{old('name', null)}}">
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
                                    <input class="form-control" type="text" name="phone" value="{{old('phone', null)}}">
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
                                           value="{{old('address', null)}}">
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
                                        <option value="on">on</option>
                                        <option value="off">off</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary" name="add" value="Сохранить">
                                </div>
                            </div>
                        </div>
                        <div id="equipment" class="tab-pane fade">
                            <h4>Оборудование</h4>
                            <div style="clear: both"></div>
                            <div id="equipment_list">
                            </div>
                            <button id="equipment_add" type="button" class="btn btn-default" style="float: right">
                                Добавить оборудование
                            </button>
                            <div class="form-group">
                                <div class="col-md-9">
                                    <input type="submit" class="btn btn-primary" name="add" value="Сохранить">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection