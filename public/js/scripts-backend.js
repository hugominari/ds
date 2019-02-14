$(document).ready(function () {

  new WOW().init();

  $('.button-collapse').sideNav();

  fixeActions();

  $('.mdb-select').materialSelect();

  $(document).on('click', 'button[href]', function (e) {
    var url = $(this).attr('href');
    window.location.href = url;
  });

  $('#toggler').click(function () {
    var $radios = $('.permissions-box input[name*="permissions"]');
    if ($(this).is(':checked')) {
      $radios.prop('checked', true);
    } else {
      $radios.prop('checked', false);
    }
  });

  if (dev.readOnly) {
    $('main :input:not(.keep-editable)').prop('disabled', true);
    $('[data-type*=dropzone]').addClass('disabled');
    $('</p>').addClass('alert alert-warning').html('No modo de <b>visualização</b> todos os campos são bloqueados.').appendTo($('section.content-header'));
  }
});

/*
 * When the browser is resized.
 */
$(window).resize(function () {
  fixeActions();
});

/**
 * Fix the div with actions button
 */
function fixeActions() {
  var screenWidth = $(document).outerWidth();
  var sideBar = $('#slide-out').outerWidth();
  var width = screenWidth - sideBar;
  var sideVisible = $('.custom-scrollbar').is(':visible');

  $('.js-fixed-actions').removeClass('hide');
  $('.js-fixed-actions').css({
    'position': 'fixed',
    'bottom': '2px',
    'height': '66px',
    'padding': '4px 16px 0px',
    'margin': '0',
    'border-top': '2px solid #222D32',
    'background-color': 'rgba(190, 190, 190, 0.6)',
    'z-index': '98'
  });

  var content = $('main');
  content.css('padding-bottom', '90px');

  if (screenWidth > 1440) {
    $('.js-fixed-actions').css({
      'width': width,
      'right': '0'
    });
  } else {
    $('.js-fixed-actions').css({
      'width': '100%',
      'right': '0px'
    });
  }
}

$(document).on('change', '#icon', function (e) {
  e.preventDefault();
  var val = $(this).val();
  var icon = '<i class="fab fa-' + val + ' font-48"></i>';
  var box = $('.box-icon');

  box.html(icon);
});

$(document).on('click', '#create-attendance', function (e) {
  e.preventDefault();
  $('#makeAttendance').modal('show');
});
