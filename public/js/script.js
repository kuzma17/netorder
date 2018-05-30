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
               }
           }
       });
   });

    $( function() {
        $('input[name=date_from], input[name=date_to], input[name=date_end]').datepicker({
            dateFormat: "yy-mm-dd"
        });
    } );

    $('#firm div select[name=firm]').change(function () {
        var token = $('input[name=_token]').val();
        var firm_id = $('#firm div select[name=firm]').val();
        //alert(firm_id);
        $.post('/branch', {'_token': token, id: firm_id}, function (data) {
            $('#branch').show();
            $('#branch div select[name=branch]').html(data);
        })
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
});