@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.message')
                <a href="{{route('printers.create')}}" ><button type="button" class="btn btn-success">Создать принтер</button></a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($printers as $printer)
                        <tr>
                            <td>{{$printer->id}}</td>
                            <td>{{$printer->name}}</td>
                            <td>
                                <a title="Просмотр подрядчика" href="{{route('printers.show', ['id'=>$printer->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                <a title="Редактировать подрядчика" href="{{route('printers.edit', ['id'=>$printer->id])}}" ><i class="fa fa-edit"></i></a>
                                <a title="Удалить подрядчика" href="{{route('printer.del', ['id'=>$printer->id])}}" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>

                {!! $printers->render() !!}

            </div>
        </div>
    </div>
@endsection