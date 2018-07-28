<div class="row cartridge">
    <label class="col-md-3 control-label">Картридж/Количество</label>
    <div class="col-md-6">
        <select name="cartridge[{{$printer_id}}][]" class="form-control select_order_cartridge" required>

               <option value="">Выберите картридж</option>

            @foreach($cartridges as $cartridge)
                @if(count($select_cartridges) > 0 && in_array($cartridge->id, $select_cartridges))
                    @continue
                @endif
                <option value="{{ $cartridge->id }}">{{ $cartridge->name }}</option>
            @endforeach
        </select>
     </div>
    <div class="col-md-2">
        <input class="form-control" type="text" name="count_cartridge[{{$printer_id}}][]" value="1" required>
    </div>
    <div class="col-md-1">
        <a href="#" class="order_del_cartridge" title="Удалить картридж">
            <i class="fa fa-times red"></i>
        </a>
    </div>
</div>