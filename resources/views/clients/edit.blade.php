@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование филиала</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="order_order" method="post" class="form-horizontal"
                      action="{{ route('client.edit', ['id'=>$client->id]) }}">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Firm<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="firm" class="form-control">
                                @foreach($client->firms() as $firm)
                                    <option value="{{ $firm->id }}"
                                            @if($client->firm_id == $firm->id) selected @endif >{{ $firm->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Region<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="region" class="form-control">
                                @foreach($client->regions() as $region)
                                    <option value="{{ $region->id }}"
                                            @if($client->region_id == $region->id) selected @endif>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Town<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="town" class="form-control">
                                @foreach($client->towns() as $town)
                                    <option value="{{ $town->id }}"
                                            @if($client->town_id == $town->id) selected @endif>{{ $town->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="user" class="form-control">
                                @foreach($client->users() as $user)
                                    <option value="{{ $user->id }}"
                                            @if($client->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Name<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name" value="{{old('name', $client->name)}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">phone <span class="red">*</span></label>
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
                        <label class="col-md-3 control-label">address <span class="red">*</span></label>
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
                        <label class="col-md-3 control-label">status</label>
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
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection