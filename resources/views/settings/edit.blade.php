@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Параметры</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="settings_form" method="post" class="form-horizontal"
                      action="{{ route('setting.update') }}">
                {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Телефон<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="phone"
                                   value="{{old('phone', $setting->get('phone'))}}">
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">обраный E-mail<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="email"
                                   value="{{old('email', $setting->get('email'))}}">
                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('paginate') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">количество позиций на странице<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="paginate"
                                   value="{{old('paginate', $setting->get('paginate'))}}">
                            @if ($errors->has('paginate'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('paginate') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9">
                            <input type="submit" class="btn btn-primary" value="Сохранить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection