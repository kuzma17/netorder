@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form name="order_order" method="post" class="form-horizontal" action="{{ route('user.edit', ['id'=>$user->id]) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">Login<span class="red">*</span></label>
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
                                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email', $user->email) }}" required>

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <!--<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <label for="password" class="col-md-4 control-label">Password</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>

                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                </div>
                            </div>-->
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Role<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="role[]" class="form-control" multiple="multiple">
                                        @foreach($user->role_list() as $role)
                                            <option value="{{ $role->id }}" @if($user->is_role($role->id)) selected @endif>{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">full name<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="full_name" value="{{old('full_name', $user->profile->name)}}">
                                    @if ($errors->has('full_name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('full_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">phone <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="phone" value="{{old('phone', $user->profile->phone)}}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Firm<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="firm" class="form-control">
                                        @foreach($user->firm_list() as $firm)
                                            <option value="{{ $firm->id }}" @if($firm->id == $user->profile->firm_id) selected @endif>{{ $firm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Branch<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="branch" class="form-control">
                                        @foreach($user->firm_list() as $branch)
                                            <option value="{{ $branch->id }}" >{{ $branch->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">status</label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="off" @if($user->profile->status == 'off') selected @endif>off</option>
                                        <option value="on" @if($user->profile->status == 'on') selected @endif>on</option>
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
        </div>
    </div>
@endsection