/**
 * Basic record edit button
 */

$(document).ready(function () {
  $(document).on('click', '.js-edit-basic', function (e) {
    e.preventDefault();

    //Get informations of record.
    var form = $('form.ajax-form');
    var action = $(this).attr('href');
    var values = form.serialize();

    $.ajax({
      dataType: 'json',
      type: 'POST',
      url: action,
      data: values,
      success: function success(response) {
        if (response.success) {
          $('body,html').animate({
            scrollTop: 0
          }, 600);
          $.each(response.data, function (index, value) {
            var element = $('#' + index);

            if (element.is('input')) element.val(value).focus();else if (element.is('textarea')) element.append(value).focus();else if (element.is('select')) element.val(value);
          });
        }
      },
      error: function error(data) {
        generateNotify(data.title, data.message, data.type);
      }
    });
  });
});
