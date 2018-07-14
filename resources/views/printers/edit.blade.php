@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Редактирование принтера</h3>
                <div style="clear: both"></div>
                <p class="panel-info"><i class="fa fa-info-circle" aria-hidden="true"></i> Поля отмеченные <span
                            class="red">*</span> обязательны для заполнения.</p>

                <form name="printer_form" method="post" class="form-horizontal"
                      action="{{ route('printers.update', ['id'=>$printer->id]) }}">
                {{ csrf_field() }}
                <!--<input name="_method" type="hidden" value="PUT">-->
                    {{ method_field('PUT') }}
                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label class="col-md-3 control-label">Название<span class="red">*</span></label>
                        <div class="col-md-9">
                            <input class="form-control" type="text" name="name"
                                   value="{{old('name', $printer->name)}}">
                            @if ($errors->has('name'))
                                <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div id="cartridge_list">
                        @foreach($printer->cartridges as $cartridge)
                            <div class="form-group cartridge">
                                <label class="col-md-3 control-label">Картридж</label>
                                <div class="col-md-8">
                                        <input type="hidden" class="select_cartridge" name="cartridge[]" value="{{$cartridge->id}}">
                                        <div class="divtoinput">{{$cartridge->name}}</div>
                                    </div>
                                <div class="col-md-1" ><a href = "#" class="cartridge_del" title = "Удалить картридж" ><i class="fa fa-times red" ></i ></a ></div>
                            </div>
                        @endforeach
                    </div>
                    <button id="addCartridge" type="button" style="float: right"><i class="fa fa-plus-circle"></i> картридж</button>
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