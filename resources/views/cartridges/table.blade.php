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