@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Создание новой организации</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal" action="{{ route('firm.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Название организации<span class="red">*</span></label>
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
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">E-mail <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="email" value="{{old('email', null)}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
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
                </form>

                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Необходимо создать хотя-бы 1 офис.</p>
            </div>
        </div>
    </div>
@endsection