@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Login</div>

                    <div class="panel-body">
                        @include('layouts.message')
                        <a href="{{route('contractor.add')}}" ><button type="button" class="btn btn-success">Add contractor</button></a>
                        <table class="table">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>name</th>
                                <th>user</th>
                                <th>phone</th>
                                <th>status</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($contractors as $contractor)
                                <tr>
                                    <td>{{$contractor->id}}</td>
                                    <td>{{$contractor->name}}</td>
                                    <td>{{$contractor->user->name}}</td>
                                    <td>{{$contractor->phone}}</td>
                                    <td>{{$contractor->status}}</td>
                                    <td>
                                        <a href="{{route('contractor.edit', ['id'=>$contractor->id])}}" ><i class="fa fa-edit"></i></a>
                                        <a href="{{route('contractor.del', ['id'=>$contractor->id])}}" ><i class="fa fa-trash"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                            <tbody>
                            </tbody>
                        </table>

                        {!! $contractors->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection