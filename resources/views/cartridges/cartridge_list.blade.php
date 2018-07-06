<div class="form-group cartridge">
    <label class="col-md-3 control-label">Картридж</label>
    <div class="col-md-8">
        <select class="form-control select_cartridge" name="cartridge[]">
            @foreach($cartridges as $cartridge)
                @if(count($select_cartridges) > 0 && in_array($cartridge->id, $select_cartridges))
                    @continue
                @endif
                <option value="{{$cartridge->id}}">{{$cartridge->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-md-1">
        <a href="#" class="cartridge_del" title="Удалить картридж">
            <i class="fa fa-times red"></i>
        </a>
    </div>
</div>