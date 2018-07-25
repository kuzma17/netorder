<div class="row cartridge">
    <label class="col-md-3 control-label">Картридж/Количество</label>
    <div class="col-md-6">
        <input type="hidden" name="cartridge[]" value="{{$cartridge->id}}">
        <input type="text" class="form-control" name="" value="{{$cartridge->name}}">
    </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="count_cartridge[]" value="1" required>
    </div>
    <div class="col-md-1">
        <a href="#" class="order_del_cartridge" title="Удалить картридж">
            <i class="fa fa-times red"></i>
        </a>
    </div>
</div>