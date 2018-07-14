<table class="table table-bordered">
    <thead>
    <tr>
        <th>id</th>
        <th>Регион</th>
        <th>Название</th>
        <th></th>
    </tr>
    </thead>
    @foreach($cites as $city)
        <tr>
            <td>{{$city->id}}</td>
            <td>{{$city->region->name}}</td>
            <td>{{$city->name}}</td>
            <td>
                <a title="Просмотр населенного пункта" href="{{route('cites.show', ['id'=>$city->id])}}"><i class="fa fa-eye" aria-hidden="true"></i></a>
                <a title="Редактировать населенного пункта" href="{{route('cites.edit', ['id'=>$city->id])}}" ><i class="fa fa-edit"></i></a>
                <a title="Удалить населенный пункт" href="{{route('cites.del', ['id'=>$city->id])}}" ><i class="fa fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    <tbody>
    </tbody>
</table>