@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование населенного пункта</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="city_form" method="post" class="form-horizontal"
                      action="{{ route('cites.update', ['id'=>$city->id]) }}">
                {{ csrf_field() }}
                <!--<input name="_method" type="hidden" value="PUT">-->
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label class="col-md-3 control-label">Регион<span class="red">*</span></label>
                        <div class="col-md-9">
                            <select name="region" class="form-control" required>
                                <option value="">Выберите регион</option>
                                @foreach($city->list_regions() as $region)
                                    <option value="{{ $region->id }}" @if($city->region_id == $region->id) selected @endif>{{ $region->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Название<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name"
                                   value="{{old('name', $city->name)}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-9">
                            <input type="submit" class="btn btn-primary" name="add_all_city" value="Сохранить">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection