@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        <form name="order_order" method="post" class="form-horizontal" action="{{ route('order.add') }}">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Тип услуги<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="type_work" class="form-control">
                                        @foreach($order->typeWorks() as $type)
                                            <option value="{{ $type->id }}" >{{ $type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Contractor<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="contractor" class="form-control">
                                        @foreach($order->contractors() as $contractor)
                                            <option value="{{ $contractor->id }}" >{{ $contractor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group{{ $errors->has('date_end') ? ' has-error' : '' }}">
                                <label  class="col-md-3 control-label">дата выполнения</label>
                                <div class="col-md-9">
                                   <input class="form-control" type="date" name="date_end" value="{{old('date_end', null)}}">
                                    @if ($errors->has('date_end'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('date_end') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Комментарий</label>
                                <div class="col-md-9">
                                    <textarea class="form-control" name="comment">{{old('comment', null)}}</textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <label  class="col-md-3 control-label">Status<span class="red">*</span></label>
                                <div class="col-md-9">
                                    <select name="status" class="form-control">
                                        @foreach($order->statuses() as $status)
                                            <option value="{{ $status->id }}" >{{ $status->name }}</option>
                                        @endforeach
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