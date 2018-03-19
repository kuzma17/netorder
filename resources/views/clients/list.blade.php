@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        @include('layouts.message')
                        <a href="{{route('client.add')}}" ><button type="button" class="btn btn-success">Add client</button></a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>full name</th>
                                <th>phone</th>
                                <th>status</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($clients as $client)
                                <tr>
                                    <td>{{$client->id}}</td>
                                    <td>{{$client->name}}</td>
                                    <td>{{$client->full_name}}</td>
                                    <td>{{$client->phone}}</td>
                                    <td>{{$client->status}}</td>
                                    <td>
                                        <a href="{{route('client.edit', ['id'=>$client->id])}}" ><i class="fa fa-edit"></i></a>
                                        <a href="{{route('client.del', ['id'=>$client->id])}}" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>

                        {!! $clients->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection