@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form name="order_order" method="post" class="form-horizontal" action="{{ route('client.add') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Firm<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="firm" class="form-control">
                                        @foreach($client->firms() as $firm)
                                            <option value="{{ $firm->id }}" @if($firm->id == Request::get('firm')) selected @endif>{{ $firm->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Region<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="region" class="form-control">
                                        @foreach($client->regions() as $region)
                                            <option value="{{ $region->id }}" >{{ $region->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Town<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="town" class="form-control">
                                        @foreach($client->towns() as $town)
                                            <option value="{{ $town->id }}" >{{ $town->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">User<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="user" class="form-control">
                                        @foreach($client->users() as $user)
                                            <option value="{{ $user->id }}" >{{ $user->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
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
                            <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">address <span class="red">*</span></label>
                                <div class="col-md-9">
                                    <input class="form-control" type="text" name="address" value="{{old('address', null)}}">
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
                                        <option value="on" >on</option>
                                        <option value="off" >off</option>
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