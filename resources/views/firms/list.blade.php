@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        @include('layouts.message')
                        @can('add', \App\Firm::class)
                            <a href="{{route('firm.add')}}">
                                <button type="button" class="btn btn-success">Add firm</button>
                            </a>
                        @endcan
                        <div class="table_header">
                            <div class="col-md-1">id</div>
                            <div class="col-md-9">Наименование</div>
                            <div class="col-md-1">статус</div>
                            <div class="col-md-1"></div>
                        </div>
                        <div class="table_border">
                            @foreach($firms as $firm)
                                <div class="">
                                    <div class="firm_line">
                                        <div class="col-md-1 firm_dropdown">{{$firm->id}}</div>
                                        <div class="col-md-9 firm_dropdown">{{$firm->name}}</div>
                                        <div class="col-md-1 firm_dropdown">{{$firm->status}}</div>
                                        <div class="col-md-1">
                                            <a href="#" class="firm_dropdown"><i class="fa fa-angle-double-down"
                                                                                 aria-hidden="true"></i></a>
                                            <a href="{{route('firm.edit', ['id'=>$firm->id])}}"><i
                                                        class="fa fa-edit"></i></a>
                                            <a href="{{route('firm.del', ['id'=>$firm->id])}}"><i
                                                        class="fa fa-trash"></i></a>
                                        </div>
                                    </div>
                                    <div class="branch">
                                        @if(\App\Client::where('firm_id', $firm->id)->count() > 0)
                                            @foreach(\App\Client::where('firm_id', $firm->id)->get() as $client)
                                                <div class="client_line">
                                                    <div class="col-md-1"></div>
                                                    <div class="col-md-1">{{$client->id}}</div>
                                                    <div class="col-md-8">{{$client->name}}</div>
                                                    <div class="col-md-1">{{$client->status}}</div>
                                                    <div class="col-md-1">
                                                        <a href="{{route('client.edit', ['id'=>$client->id])}}"><i
                                                                    class="fa fa-edit"></i></a>
                                                        <a href="{{route('client.del', ['id'=>$client->id])}}"><i
                                                                    class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <div class="client_line">
                                            @can('add', \App\Firm::class)
                                                <a href="{{route('client.add', ['firm'=>$firm->id])}}"
                                                   style="float: right">
                                                    <button type="button" class="btn btn-success">создать филиал
                                                    </button>
                                                </a>
                                            @endcan
                                            <div style="clear: both"></div>
                                        </div>
                                        <div style="clear: both"></div>
                                    </div>
                                    <div style="clear: both"></div>
                                </div>
                            @endforeach
                            <div style="clear: both"></div>
                        </div>


                        {!! $firms->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection