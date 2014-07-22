jQuery(document).ready(function($) {

  var gform = $(document).find('.gform_wrapper').attr('class');

  if (typeof gform !== 'undefined' && gform !== 'false') {
    $(document).on('gform_post_render', function() {

      var form = $('.gform_wrapper');
      var required = $('.gfield_contains_required');

      // Remove extra ul left by column wrapper code
      // Wrap .gform_body in Bootstrap .row
      // Remove extra .gsection elements
      if ($('.gform_columns').length) {
        $('.gform_columns .gform_body > ul').first().remove();
        $('.gform_columns .gform_body').wrapInner('<div class="row"></div>');
        $('.gform_columns .gsection').remove();
      }

      // Inputs
      $('.gfield').each(function() {
        $(this).addClass('form-group').find('input, textarea, select').not('input[type="checkbox"], input[type="radio"], input[type="submit"], input[type="hidden"]').addClass('form-control');
      });

      // Buttons
      $('.gform_button').addClass('btn btn-primary')

      // Alerts
      $('.validation_error').addClass('alert alert-danger');
      $('#gforms_confirmation_message').addClass('alert alert-warning');

    });
  }

});
