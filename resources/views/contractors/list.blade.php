@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                        @include('layouts.message')
                        <a href="{{route('contractor.add')}}" ><button type="button" class="btn btn-success">Создать подрядчика</button></a>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>id</th>
                                <th>Название</th>
                                <th>телефон</th>
                                <th>статус</th>
                                <th></th>
                            </tr>
                            </thead>
                            @foreach($contractors as $contractor)
                                <tr>
                                    <td>{{$contractor->id}}</td>
                                    <td>{{$contractor->name}}</td>
                                    <td>{{$contractor->phone}}</td>
                                    <td>{{$contractor->status}}</td>
                                    <td>
                                        <a title="Просмотр подрядчика" href="{{route('contractor.view', ['id'=>$contractor->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a title="Редактировать подрядчика" href="{{route('contractor.edit', ['id'=>$contractor->id])}}" ><i class="fa fa-edit"></i></a>
                                        <a title="Удалить подрядчика" href="{{route('contractor.del', ['id'=>$contractor->id])}}" ><i class="fa fa-trash"></i></a>
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
@endsection