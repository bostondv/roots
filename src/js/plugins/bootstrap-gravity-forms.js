(function($) {

  // Remove extra ul left by column wrapper code
  // Wrap .gform_body in Bootstrap .row
  // Remove extra .gsection elements
  if ($('.gform_columns').length) {
    $('.gform_columns .gform_body > ul').first().remove();
    $('.gform_columns .gform_body').wrapInner('<div class="row"></div>');
    $('.gform_columns .gsection').remove();
  }

})(jQuery);
