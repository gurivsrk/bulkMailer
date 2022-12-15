$(document).ready(function(){

      $(".select2").select2({
        tags: true,
        placeholder: 'Select an option or Add new',
      });

      $(".select1").select2({
        placeholder: 'Select an option or Add new',
      });

      $('#datatable').DataTable({
        stateSave: true,
        iDisplayLength:50,
        responsive: true,
        fixedHeader: {
          header: true,
          footer: true
      }
      });



    $('.tableInput').on('click', function(){
        $(this).attr('readonly',false);
    })


});
