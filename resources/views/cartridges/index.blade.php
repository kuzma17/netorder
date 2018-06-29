@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                @include('layouts.message')
                <a href="{{route('cartridges.create')}}" ><button type="button" class="btn btn-success">Создать картридж</button></a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>id</th>
                        <th>Название</th>
                        <th></th>
                    </tr>
                    </thead>
                    @foreach($cartridges as $cartridge)
                        <tr>
                            <td>{{$cartridge->id}}</td>
                            <td>{{$cartridge->name}}</td>
                            <td>
                                <a title="Редактировать картридж" href="{{route('cartridges.edit', ['id'=>$cartridge->id])}}" ><i class="fa fa-edit"></i></a>
                                <a title="Удалить картридж" href="{{route('cartridges.del', ['id'=>$cartridge->id])}}" ><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    <tbody>
                    </tbody>
                </table>

                {!! $cartridges->render() !!}

            </div>
        </div>
    </div>
@endsection