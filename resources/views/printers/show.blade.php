@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Просмотр принтера</h3>
                <div style="clear: both"></div>
                @include('layouts.message')
                <table class="table table-bordered">
                    <tbody>
                    <tr>
                        <td>Модель принтера</td>
                        <td>{{ $printer->name }}</td>
                    </tr>
                    @if(count($printer->cartridges) > 0)
                        @foreach($printer->cartridges as $cartridge)
                            <tr>
                                <td>Картридж</td>
                                <td>{{ $cartridge->name }}</td>
                            </tr>
                        @endforeach
                     @endif
                    </tbody>
                </table>
                <a href="{{route('printers.edit', $printer->id)}}">
                    <button type="button" class="btn btn-success">Редактировать</button>
                </a>
                <a href="{{route('printers.index')}}">
                    <button type="button" class="btn btn-success">Все принтеры</button>
                </a>

            </div>
        </div>
    </div>
@endsection