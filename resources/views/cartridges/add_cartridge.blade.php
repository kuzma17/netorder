@foreach ($cartridges as $cartridge)
<div class="row cartridge">
    <label class="col-md-3 control-label">Картридж/Стоимость</label>
    <div class="col-md-4">
        <input type="hidden" name="cartridge[{{$printer_id}}][]" value="{{$cartridge->id}}">
        <div class="divtoinput">{{$cartridge->name}}</div></div>
    <div class="col-md-2"><input class="form-control" type="text" name="price[{{$printer_id}}][{{$cartridge->id}}]" required>
    </div>
    <div class="col-md-2"><input class="form-control" type="text" name="price2[{{$printer_id}}][{{$cartridge->id}}]" required>
    </div>
</div>
@endforeach