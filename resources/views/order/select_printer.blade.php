<div class="printer">
<div class="form-group">
    <label class="col-md-3 control-label">Принтер</label>
    <div class="col-md-9">
        <select name="printer[]" class="form-control select_printer" required>
            <!--<option value="">Выберите принтер</option>-->
            @foreach($printers as $printer)
                <option value="{{ $printer->id }}">{{ $printer->name }}</option>
            @endforeach
        </select>
    </div>
</div>
</div>