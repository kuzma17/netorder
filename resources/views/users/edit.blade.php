@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование пользователя</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal"
                      action="{{ route('user.edit', ['id'=>$user->id]) }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Логин <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name" value="{{old('name', $user->name)}}">
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
                            <input id="email" type="email" class="form-control" name="email"
                                   value="{{ old('email', $user->email) }}" required>

                            @if ($errors->has('email'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="role">
                        <label class="col-md-3 control-label">Тип пользователя <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="role" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}" @if($user->profile->role_id == $role->id) selected @endif>{{ $role->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">ФИО <span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="full_name"
                                   value="{{old('full_name', $user->profile->name)}}">
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
                            <input class="form-control" type="text" name="phone"
                                   value="{{old('phone', $user->profile->phone)}}" required>
                            @if ($errors->has('phone'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('firm') ? ' has-error' : '' }}" id="firm" @if(count($firms) < 1) style="display: none" @endif>
                        <label class="col-md-3 control-label">Организация <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="firm" class="form-control">
                                @foreach($firms as $firm)
                                    <option value="{{ $firm->id }}"
                                            @if($firm->id == $user->profile->firm_id) selected @endif>{{ $firm->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('firm'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('firm') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group" id="branch" @if(count($branches) < 1) style="display: none" @endif>
                        <label class="col-md-3 control-label">Офис <span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="branch" class="form-control">
                                @foreach($branches as $branch)
                                    <option value="{{ $branch->id }}" @if($user->profile->branch_id == $branch->id) selected @endif>{{ $branch->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Статус</label>
                        <div class="col-md-9">
                            <select name="status" class="form-control">
                                <option value="on" @if($user->profile->status == 'on') selected @endif>on</option>
                                <option value="off" @if($user->profile->status == 'off') selected @endif>off</option>
                            </select>
                        </div>
                    </div>
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