@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                        @include('layouts.message')
                        @can('add', \App\Firm::class)
                            <a href="{{route('firm.add')}}">
                                <button type="button" class="btn btn-success">Add firm</button>
                            </a>
                        @endcan

                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Наименование</th>
                                <th>статус</th>
                                <th></th>
                            </tr>
                            </thead>

                            @foreach($firms as $firm)
                            <tr  style="border: 1px solid lightgray">
                                <td class="col-md-1 firm_dropdown">{{$firm->id}}</td>
                                <td class="col-md-9 firm_dropdown">{{$firm->name}}</td>
                                <td class="col-md-1 firm_dropdown">{{$firm->status}}</td>
                                <td class="col-md-1">
                                    <a href="#" class="firm_dropdown"><i class="fa fa-caret-down down"
                                                                         aria-hidden="true"></i></a>
                                    <a href="{{route('firm.edit', ['id'=>$firm->id])}}"><i
                                                class="fa fa-edit"></i></a>
                                    <a href="{{route('firm.del', ['id'=>$firm->id])}}"><i
                                                class="fa fa-trash"></i></a>
                                </td>
                            </tr>
                                    <tr class="branch" @if(!$id || ($id && $id != $firm->id)) style="display: none" @endif>
                                        <td colspan="4" style="border: none;">
                                        @if(\App\Client::where('firm_id', $firm->id)->count() > 0)
                                            <table class="table table-bordered" style="width: 97%; float: right; margin-top: -8px; background-color: white">
                                            @foreach(\App\Client::where('firm_id', $firm->id)->get() as $client)
                                                <tr class="client_line">
                                                    <td class="col-md-1">{{$client->id}}</td>
                                                    <td class="col-md-8">{{$client->name}}</td>
                                                    <td class="col-md-1">{{$client->status}}</td>
                                                    <td class="col-md-1">
                                                        <a href="{{route('client.edit', ['id'=>$client->id])}}"><i
                                                                    class="fa fa-edit" style="color: green"></i></a>
                                                        <a href="{{route('client.del', ['id'=>$client->id])}}"><i
                                                                    class="fa fa-trash" style="color: red"></i></a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </table>
                                        @endif
                                            @can('add', \App\Firm::class)
                                                <a href="{{route('client.add', ['firm'=>$firm->id])}}"
                                                   style="float: right; margin-top: -20px">
                                                    <button type="button" class="btn btn-default" style="border-color: green">создать филиал
                                                    </button>
                                                </a>
                                            @endcan
                                        </td>
                                    </tr>


                            @endforeach
                            </table>



                        {!! $firms->render() !!}

            </div>
        </div>
    </div>
@endsection