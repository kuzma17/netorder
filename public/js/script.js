/**
 * Created by kuzma on 28.02.18.
 */
$(document).ready(function () {

   $('#act').change(function (event) {

       event.stopPropagation();
       event.preventDefault();

       var data = new FormData();
       var file_data = $('#act').prop('files')[0];
       var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.pdf)/i;
       var token = $('input[name=_token]').val();

       if(!allowedExtensions.exec(file_data.name)){
           alert('Please upload file having extensions .jpeg/.jpg/.png/.gif/.pdf only.');
           return false;
       }
       if(file_data.size > 500000){
           alert('Big size!!! Max 500kb');
           return false;
       }

       data.append('file', file_data);
       data.append('_token', token);

       $.ajax({
           url: "/upload",
           type: 'POST',
           data: data,
           cache: false,
           dataType: 'json',
           processData: false,
           contentType: false,
           success: function(respond){
               //console.log(respond);
               //console.log(respond.error);
               if(respond.error){
                   alert(respond.error);
                   return false;
               }
               if(respond.type != 'application/pdf') {
                   $('.ajax-respond img').attr('src', respond.src);
                   $('.ajax-respond input[name=act_complete]').val(respond.src);
               }
           }
       });
   });

    $( function() {
        $('input[name=date_from], input[name=date_to], input[name=date_end]').datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );

    $('#role div select[name=role]').change(function () {
        var token = $('input[name=_token]').val();
        var role = $(this).val();
        $('#firm div select[name=firm]').prop('required',false);
        $('#branch div select[name=branch]').prop('required',false);
        if(role == 1){
            $('#firm').hide();
            $('#branch').hide();
        }
        if(role == 2 || role == 3){
            if(role == 2){
                $('#branch').hide();
            }
            $.post('/ajax_firm', {'_token': token}, function (data) {
                if(data) {
                    $('#firm').show();
                    $('#firm div select[name=firm]').html(data);
                    $('#firm div select[name=firm]').prop('required',true);
                }
            })
        }
        if(role == 4){
            $('#branch').hide();
            $.post('/ajax_contractor', {'_token': token}, function (data) {
                if(data) {
                    $('#firm').show();
                    $('#firm div select[name=firm]').html(data);
                    $('#firm div select[name=firm]').prop('required',true);
                }
            })
        }
    });

    $('#firm div select[name=firm]').change(function () {
        var role = $('#role div select[name=role]').val();
        if(role == 3) {
            var token = $('input[name=_token]').val();
            var firm_id = $('#firm div select[name=firm]').val();
            $.post('/ajax_branch', {'_token': token, id: firm_id}, function (data) {
                $('#branch').hide();
                if (data) {
                    $('#branch').show();
                    $('#branch div select[name=branch]').html(data);
                    $('#branch div select[name=branch]').prop('required',true);
                }
            })
        }
    });

    $('#firm').change(function () {
        var token = $('input[name=_token]').val();
        var firm_id = $('#firm').val();
        $.post('/ajax_branch', {'_token': token, id: firm_id}, function (data) {
            if (data) {
                $('#branch').html(data);
            }
        });
    });


    $('td.firm_dropdown').click(function () {
        $(this).parent().next('.branch').toggle(500);
        $(this).parent().find('td a i.down').toggleClass("fa-caret-up");
        return false;
    });

    $('a.firm_dropdown').click(function () {
        $(this).parents(1).next('.branch').toggle(500);
        $(this).children('i').toggleClass("fa-caret-up");
        return false;
    });

    $('.filter_btn').click(function () {
        $('.filter').slideToggle(500);
        var icon_h = $(this).children('i.down');
        if(icon_h.hasClass("fa-caret-up")){
            icon_h.removeClass("fa-caret-up");
            icon_h.addClass("fa-caret-down");
        }else{
            icon_h.removeClass("fa-caret-down");
            icon_h.addClass("fa-caret-up");
        }
        return false;
    });

    $('#submit_filter').click(function () {
       $('form[name=filter]').submit();
    });
    
    $('#reset_filter').click(function () {
        $('input[name=date_from]').val('');
        $('input[name=date_to]').val('');
        $("#firm option:first").prop('selected', true);
        $("#branch option:first").prop('selected', true);
        $("#contractor option:first").prop('selected', true);
        $("#status option:first").prop('selected', true);
    });

    $(document).on("click", "a i.fa-trash", function () {
        if(confirm('Вы уверены что хотите удалить?')){
            return true;
        }
        return false;
    });


    $('#equipment_add').click(function () {
        var token = $('input[name=_token]').val();
        var printers = $('.select_printer').map(function() {
            return $(this).val();
        }).get();
        $.post('/ajax_add_printer', {'_token': token, 'printers': printers}, function (data) {
            if (data) {
                $('#equipment_list').append(data);
            }
        });
        $(this).prop("disabled",true);
        return false;
    });


    $(document).on('change', '.select_printer', function () {
        var token = $('input[name=_token]').val();
        var printer = $(this).val();
        var regenerate = $(this).parents(1).next('.regenerate');
        $.post('/ajax_add_cartridge', {'_token': token, 'printer': printer}, function (data) {
            if (data) {
                regenerate.html(data);
                $('#equipment_add').prop("disabled", false);
            }
        });
        return false;
    });

    $(document).on('click', '.cartridge_del', function () {
        $(this).closest('.cartridge').remove();
        return false;
    });

    $(document).on('click', '.equipment_del', function () {
        $(this).closest('.printer').remove();
        $('#equipment_add').prop("disabled", false);
        return false;
    });

    $('.tooltip-info').tooltip();


    $("#addCartridge").click(function () {
        var token = $('input[name=_token]').val();
        var cartridges = $('.select_cartridge').map(function() {
            return $(this).val();
        }).get();
        $.post('/ajax_cartridge', {'_token': token, 'cartridges': cartridges}, function (data) {
            if (data) {
                $('#cartridge_list').append(data);
            }
        });
    });
});