@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form name="order_order" method="post" class="form-horizontal" action="{{ route('firm.add') }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">Name<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="name" value="{{old('name', null)}}">
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
                                   <input class="form-control" type="text" name="full_name" value="{{old('full_name', null)}}">
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
                                    <input class="form-control" type="text" name="phone" value="{{old('phone', null)}}">
                                    @if ($errors->has('phone'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">status</label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        <option value="off" >off</option>
                                        <option value="on" >on</option>
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
        </div>
    </div>
@endsection