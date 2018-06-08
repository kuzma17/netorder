@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Создание нового пользователя</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal" action="{{ route('user.add') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Логин <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name" value="{{old('name', null)}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-3 control-label">E-Mail <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-3 control-label">Пароль <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="password" type="password" class="form-control" name="password" required>

                            @if ($errors->has('password'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm" class="col-md-3 control-label">Пароль повторно <span class="red">*</span></label>

                        <div class="col-md-9">
                            <input id="password-confirm" type="password" class="form-control"
                                   name="password_confirmation" required>
                        </div>
                    </div>
                    <div class="form-group" id="role">
                        <label class="col-md-3 control-label">Тип пользователя <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="role" class="form-control">
                                <option value="0">Выберите тип пользователя</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->label }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">ФИО <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="full_name" value="{{old('full_name', null)}}">
                            @if ($errors->has('full_name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
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
                    <div class="form-group" id="firm" style="display: none">
                        <label class="col-md-3 control-label">Организация <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="firm" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="branch" style="display: none">
                        <label class="col-md-3 control-label">Филиал <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="branch" class="form-control">
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Статус</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control">
                                <option value="on" @if(old('status') == 'on') selected @endif>on</option>
                                <option value="off" @if(old('status') == 'off') selected @endif>off</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-9">
                            <input type="submit" class="btn btn-primary" name="add" value="Сохранить">
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection