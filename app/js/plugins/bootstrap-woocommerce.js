jQuery(document).ready(function($) {

  // Wrap .input-group-btn on quantity form
  $( 'input.minus, input.plus' ).addClass('btn btn-default').wrap('<span class="input-group-btn"></span>');

});