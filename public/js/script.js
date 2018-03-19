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
});