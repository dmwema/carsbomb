(function($) {
  'use strict';
  $(function() {
    $('.file-upload-browse').on('click', function() {
      var file = $(this).parent().parent().parent().find('.file-upload-default');
      file.trigger('click');
    });
    $('.file-upload-default').on('change', function() {
      $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
    });
  });
  $('#image').change(function(){
              
    let reader = new FileReader();

    reader.onload = (e) => { 

      $('#image-preview').attr('src', e.target.result); 
    }

    reader.readAsDataURL(this.files[0]); 
  
  }); 
})(jQuery);