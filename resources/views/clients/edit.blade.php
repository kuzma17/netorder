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
                    <input type="hidden" name="firm" value="{{$client->firm_id}}">
                    <div class="form-group">
                        <label class="col-md-3 control-label">Регион<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="region" class="form-control">
                                @foreach($client->list_regions() as $region)
                                    <option value="{{ $region->id }}"
                                            @if($client->region_id == $region->id) selected @endif>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">Город, населенный пункт<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="town" class="form-control">
                                @foreach($client->list_towns() as $town)
                                    <option value="{{ $town->id }}"
                                            @if($client->town_id == $town->id) selected @endif>{{ $town->name }}</option>
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
                                    <option value="{{ $contractor->id }}"  @if($client->contractor_id == $contractor->id) selected @endif>{{ $contractor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 control-label">User<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="user" class="form-control">
                                @foreach($client->list_users() as $user)
                                    <option value="{{ $user->id }}"
                                            @if($client->user_id == $user->id) selected @endif>{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Название<span class="red">*</span></label>
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
                        <label class="col-md-3 control-label">Телефон <span class="red">*</span></label>
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
                        <label class="col-md-3 control-label">Адрес <span class="red">*</span></label>
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
                        <label class="col-md-3 control-label">Статус</label>
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