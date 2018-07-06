<div class="form-group cartridge">
    <label class="col-md-3 control-label">Картридж</label>
    <div class="col-md-9">
        <select class="form-control select_cartridge" name="cartridge" required>
            @foreach ($cartridges as $cartridge)
                <option value="{{$cartridge->id}}">{{$cartridge->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label">Количество картриджей</label>
    <div class="col-md-9">
        <input type="number" name="count_cartridge" class="form-control select_cartridge" value="1" required>
    </div>
</div>