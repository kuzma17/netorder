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
                <a title="Удалить подрядчика" href="{{route('printers.del', ['id'=>$printer->id])}}" ><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    <tbody>
    </tbody>
</table>