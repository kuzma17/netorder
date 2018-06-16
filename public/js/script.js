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
                }
            })
        }
        if(role == 4){
            $('#branch').hide();
            $.post('/ajax_contractor', {'_token': token}, function (data) {
                if(data) {
                    $('#firm').show();
                    $('#firm div select[name=firm]').html(data);
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
                }
            })
        }
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

    $('a i.fa-trash').click(function () {
        if(confirm('Вы уверены что хотите удалить?')){
            return true;
        }
        return false;
    });

    $('#equipment_add').click(function () {
        var html_item = '<div class="form-group"><label class="col-md-2 control-label">Название</label><div class="col-md-9"><input class="form-control" type="text" name="equipment[]"></div><div class="col-md-1"><a href="#" class="equipment_del" title="Удалить оборудование"><i class="fa fa-trash red"></i></a></div></div>';
        $('#equipment_list').append(html_item);
        return false;
    });

    $(document).on('click', '.equipment_del', function () {
        $(this).closest('.form-group').remove();
        return false;
    })
});