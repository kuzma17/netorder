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
                            <a href="{{route('firm.add')}}" ><button type="button" class="btn btn-success">Add firm</button></a>
                        @endcan
                        <table class="table table-bordered">
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
                            @foreach($firms as $firm)
                                <tr>
                                    <td>{{$firm->id}}</td>
                                    <td>{{$firm->name}}</td>
                                    <td>{{$firm->full_name}}</td>
                                    <td>{{$firm->phone}}</td>
                                    <td>{{$firm->status}}</td>
                                    <td>
                                        <a href="{{route('firm.edit', ['id'=>$firm->id])}}" ><i class="fa fa-edit"></i></a>
                                        <a href="{{route('firm.del', ['id'=>$firm->id])}}" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>

                        {!! $firms->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection