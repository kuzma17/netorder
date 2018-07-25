<div class="printer">
    <div class="form-group">
        <label class="col-md-3 control-label">Принтер</label>
        <div class="col-md-8">
            <select name="printer[]" class="form-control select_order_printer" required>
                <option value="">Выберите принтер</option>
                @foreach($printers as $printer)
                    @if(count($select_printers) > 0 && in_array($printer->id, $select_printers))
                        @continue
                    @endif
                    <option value="{{ $printer->id }}">{{ $printer->id }} {{ $printer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <a href="#" class="order_del_printer" title="Удалить принтер">
                <i class="fa fa-trash"></i>
            </a>
        </div>
    </div>
    <div class="regenerate"></div>

        <button type="button" class="btn btn-default add_order_cartridge" style="float: right; display: none" disabled>
            <i class="fa fa-plus-circle"></i> картридж
        </button>
   <div class="clearfix"></div>
</div>
