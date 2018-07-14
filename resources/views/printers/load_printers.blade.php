@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <h3>Load printers</h3>
                <div style="clear: both"></div>
                @include('layouts.message')

                <div>
                    <form name="load_printers" method="post" action="{{url('save_load_printers')}}">
                        {{ csrf_field() }}

                        <div id="cartridge_list">
                                <div class="form-group cartridge">
                                    <label class="col-md-3 control-label">File</label>
                                    <div class="col-md-8">
                                        <input type="file" name="file_print">
                                    </div>
                                </div>
                        </div>
<br>
                        <div id="cartridge_list">
                            <div class="form-group cartridge">
                                <div class="col-md-8">
                                    <input type="submit" value="send">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection