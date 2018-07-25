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
                $('.head_cartridges').show();
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

    $('#printer_order').change(function () {
        var token = $('input[name=_token]').val();
        var printer = $(this).val();
        $.post('/ajax_cartridge_order', {'_token': token, 'printer': printer}, function (data) {
            if (data) {
                $('#cartridge_list').html(data);
            }
        });
    });

    $('#type_work').change(function () {
       var type_work = $(this).val();
        if(type_work == 1 || type_work == 2){
            $('#block_regenerate').show();
            $('#block_regenerate').children().find('select').prop('required',true);
        }else{
            $('#block_regenerate').children().find('select').prop('required',false);
            $('#block_regenerate').hide();
        }
    });


    $('#search_cartridge').keyup(function () {
        var token = $('input[name=_token]').val();
        var search = $(this).val();
        $.post('/ajax_search_cartridge', {'_token': token, 'search': search}, function (data) {
            if (data) {
                $('#table').html(data);
            }
        });
    });

    $('#search_printer').keyup(function () {
        var token = $('input[name=_token]').val();
        var search = $(this).val();
        $.post('/ajax_search_printer', {'_token': token, 'search': search}, function (data) {
            if (data) {
                $('#table').html(data);
            }
        });
    });

    $('#search_city').keyup(function () {
        var token = $('input[name=_token]').val();
        var search = $(this).val();
        $.post('/ajax_search_city', {'_token': token, 'search': search}, function (data) {
            if (data) {
                $('#table').html(data);
            }
        });
    });

    $('#region').change(function () {
        var token = $('input[name=_token]').val();
        var region = $(this).val();
        $.post('/ajax_city_list', {'_token': token, 'region': region}, function (data) {
            if (data) {
                $('#block_city').show();
                $('#city').html(data);
            }
        });
    });

    $('#add_order_printer').click(function () {
        var token = $('input[name=_token]').val();
        var type_work = $('#type_work').val();
        var printers = $('.select_order_printer').map(function() {
            return $(this).val();
        }).get();
       // if(type_work == 3){
        //    $.post('/ajax_add_order_printer', {'_token': token, 'printers': printers}, function (data) {
         //       console.log(data);
         //       $('#order_printers').append(data.htm);
          //      if(data.add == 1){
          //          $('#add_order_printer').show();
          //      }else{
           //         $('#add_order_printer').hide();
           //     }
          //  }, "json");
       // }else{
            $.post('/ajax_add_order_printer2', {'_token': token, 'printers': printers}, function (data) {
                console.log(data);
                if(data){
                    $('#order_printers').append(data.htm);
                          if(data.add == 1){
                              $('#add_order_printer').show();
                          }else{
                             $('#add_order_printer').hide();
                         }
                    $('#add_order_printer').prop("disabled", true);
                }
            }, "json");
       // }
    });

    $(document).on("click", ".order_del_printer", function () {
        $(this).closest('.printer').remove();
        $('#add_order_printer').show();
        $('#add_order_printer').prop("disabled", false);
        return false;
    });

    $(document).on("click", ".order_del_cartridge", function () {
        $(this).closest('.regenerate').next('.add_order_cartridge').show();
        $(this).closest('.cartridge').remove();
       // alert($(this).closest('.regenerate').next('.add_order_cartridge').html());
        return false;
    });

    $('#type_work').change(function () {
        var token = $('input[name=_token]').val();
        var type_work = $('#type_work').val();
        if(type_work == 3){
            $.post('/ajax_add_order_printer', {'_token': token}, function (data) {
                console.log(data);
                $('#order_printers').html(data);
                $('#add_order_printer').hide();
            });
        }else{
            $.post('/ajax_add_order_printer2', {'_token': token}, function (data) {
                console.log(data);
                if(data){
                    //$('#order_printers').html(data);
                    //$('#add_order_printer').show();
                    $('#order_printers').html(data.htm);
                    if(data.add == 1){
                        $('#add_order_printer').show();
                    }else{
                        $('#add_order_printer').hide();
                    }
                }
            }, "json");
        }
    });

    $(document).on("click", ".add_order_cartridge", function () {
        var token = $('input[name=_token]').val();
        var printer = $(this).parent('.printer').find('.select_order_printer').val();
        var dir = $(this).prev();
        var add = $(this);
        var cartridges = $(this).prev('.regenerate').find('.select_order_cartridge').map(function() {
            return $(this).val();
        }).get();
        //alert(printer);
        $.post('/ajax_add_order_cartridge', {'_token': token, 'printer': printer, 'cartridges': cartridges}, function (data) {
            console.log(data);
            dir.append(data.htm);
            if(data.add == 1){
                add.show();
                add.prop("disabled", true);
            }else{
                add.hide();
            }
        }, "json");
    });

    $(document).on("change", ".select_order_printer", function () {
        var token = $('input[name=_token]').val();
        var printer = $(this).val();
        var dir = $(this).parent().parent().next();
        var add = $(this).parent().parent().parent().find('.add_order_cartridge');
        var cartridges = $(this).prev().find('.select_order_cartridge').map(function() {
            return $(this).val();
        }).get();
        //alert($(this).prev().html());
        $.post('/ajax_add_order_cartridge', {'_token': token, 'printer': printer, 'cartridges': cartridges}, function (data) {
            console.log(data);
            dir.html(data.htm);
            if(data.add == 1){
                add.show();
            }else{
                add.hide();
            }
            $('#add_order_printer').prop("disabled", false);
        }, "json");
    });
    
    $(document).on("change", ".select_order_cartridge", function () {
        $(this).closest('.regenerate').next('.add_order_cartridge').prop('disabled', false);
    })

});