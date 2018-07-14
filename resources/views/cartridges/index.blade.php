@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="filter">
                    <form name="filter" method="post" class="form-horizontal" action="">
                        {{ csrf_field() }}
                        <div class="col-md-6 form-group">
                            <label class="col-md-3 control-label">Название</label>
                            <div class="col-md-9 input-group-sm">
                                <input type="text" id="search_cartridge" name="search_cartridge" class="form-control" value="">
                            </div>
                        </div>
                        <!-- <div class="col-md-6 form-group">
                            <button id="reset_filter" type="button" class="btn btn-default btn-sm"
                                    style="float: right; margin-right: 5px">reset
                            </button>
                        </div>-->
                        <div style="clear: both"></div>
                    </form>
                </div>
                <div class="filter_btn">
                    <i class="fa fa-filter" aria-hidden="true"></i> filter <i class="fa fa-caret-up down"
                                                                              aria-hidden="true"></i>
                </div>
                @include('layouts.message')
                <a href="{{route('cartridges.create')}}" ><button type="button" class="btn btn-success">Создать картридж</button></a>
                <div id="table">
                    @include('cartridges.table')
                    {!! $cartridges->render() !!}
                </div>
            </div>
        </div>
    </div>
@endsection