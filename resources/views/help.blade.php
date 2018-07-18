@extends('layouts.app')
@section('content')
    <div class="container container_help">
    <div class="row">
        <div class="col-md-12">
            <h3>Помощь</h3>
            <div style="clear: both"></div>
            <div class="help">
                {!! $text->content !!}
            </div>
        </div>
    </div>
    </div>
@endsection