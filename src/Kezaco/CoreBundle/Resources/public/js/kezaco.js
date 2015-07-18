$(document).ready(function(){

  $('input.form-input').focus(function(){
    var _parent = $(this).parent();
    var _label  = $(this).prev();

    _parent.toggleClass('focused');
    _label.toggleClass('focused');
  });

  $('input.form-input').focusout(function(){
    var _parent = $(this).parent();
    var _label  = $(this).prev();
    _parent.toggleClass('focused');
    _label.toggleClass('focused');
  });

});
