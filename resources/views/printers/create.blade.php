@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Создание нового принтера</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="printer_form" method="post" class="form-horizontal" action="{{ route('printers.store') }}">
                    {{ csrf_field() }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Название<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name" value="{{old('name', null)}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div id="cartridge_list"></div>
                    <button id="addCartridge" type="button" style="float: right"><i class="fa fa-plus-circle"></i> картридж</button>
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