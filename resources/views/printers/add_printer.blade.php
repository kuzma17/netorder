<div class="printer">
    <div class="form-group">
        <label class="col-md-3 control-label">Модель принтера</label>
        <div class="col-md-8">
            <select class="form-control select_printer" name="printer[]" required>
                <option value="">Выберите модель принтера</option>
                @foreach ($printers as $printer) {
                @if(count($select_printers) > 0 && in_array($printer->id, $select_printers))
                    @continue
                @endif

                <option value="{{$printer->id}}">{{$printer->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-1">
            <a href="#" class="equipment_del" title="Удалить принтер"><i class="fa fa-trash red"></i></a>
        </div>
    </div>
    <div class="regenerate">
    </div>
    <div class="row head_cartridges">
        <div class="col-md-7"></div>
        <div class="col-md-2"><p class="small">заправка</p></div>
        <div class="col-md-2"><p class="small">восстановление</p></div>
    </div>
</div>