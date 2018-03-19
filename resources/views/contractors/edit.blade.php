@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form name="order_order" method="post" class="form-horizontal" action="{{ route('contractor.edit', ['id'=>$contractor->id]) }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label  class="col-md-3 control-label">User<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="user" class="form-control">
                                        @foreach($contractor->users() as $user)
                                            <option value="{{ $user->id }}" @if($contractor->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">Name<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="name" value="{{old('name', $contractor->name)}}">
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('full_name') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">full name<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="full_name" value="{{old('full_name', $contractor->full_name)}}">
                                    @if ($errors->has('date_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">phone <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="phone" value="{{old('phone', $contractor->phone)}}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">address <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="address" value="{{old('address', $contractor->address)}}">
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">status</label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="off" @if($contractor->status == 'off') selected @endif>off</option>
                                        <option value="on" @if($contractor->status == 'on') selected @endif>on</option>
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