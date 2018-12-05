/**
 * Function to send the form with ajax.
 */
$(document).on("click", ".js-submit", function (e) {
    e.preventDefault();
    var submit = $(this);
    var form = $('form.ajax-form');

    if (Callbacks.preSubmit()) {
        //CLean errors
        $('.form-group').removeClass('has-error').find('span.text-danger').remove();
	
		var ckfix = $('.ckeditor').length;
		if(ckfix > 0)
			CKupdate();

        if (submit.hasClass('block-body')) {
            blockUI('body');
        } else {
            submit
                .attr('disabled', true)
                .attr('old-html', submit.html())
                .html('<i class="fa fa-spin fa-spinner"></i>' + (submit.hasClass('js-submit-icon-only') ? '' : ' Aguarde'));
        }

        //Send form
        $.ajax({
            dataType: 'json',
            type: 'POST',
            url: form.attr("action"),
            data: Callbacks.serializeData(form.serializeArray()),
            success: function (data) {
                var original = data.original;

                if (original)
                    data = original;

                if (data.success) {
                    if (!!data.callback)
                        Callbacks[data.callback](data);
                    else if (!!data.message)
                        generateNotify(data.title, data.message, data.type);

                    $('.clear-inputs').trigger('click');
                    form.trigger('reset');

                    if ($('[data-type="datatables"]').length > 0)
                        $('[data-type=datatables]').DataTable().ajax.reload();
  
                  try
                  {
                    $('#makeAttendance').modal('hide');
                  }
                  catch (e)
                  {
                    console.log('');
                  }
                }
            },
            error: function (jqXhr, json, errorThrown) {
                //Get errors
                var response = jqXhr.responseJSON;

                if (!!response) {
                    response = response.errors;

                    //Display errors on inputs
                    $.each(response, function (index, value) {
                        var input = $('#' + index);

                        if (input.length < 1)
                            input = $('[name=' + index + ']');

                        var boxError = input.parents('.form-group, .md-form');
                        var type = input.attr('type');
                        var isDropzone = boxError.find('.dropzone').length > 0;

                        if (isDropzone)
                            boxError.find('.dropzone').addClass('with-error');
                        else
                            boxError.addClass('has-error');

                        //Inputs Hidden
                        if (input.hasClass('hide') || !!input.attr('data-error')) {
                            var elementError = input.attr('data-error');

                            if (elementError)
                                $(elementError).css('border-color', 'red');
                        }

                        if (type == 'checkbox' || type == 'radio') {
                            boxError.find('.span-error').remove();
                            boxError.append(
                                '<span class="text-danger d-block span-error">'
                                + '<i class="fa fa-exclamation-circle m-r-5" aria-hidden="true"></i>'
                                + value
                                + '</span>'
                            );
                        }
                        else {
                            boxError.find('.span-error').remove();
                            boxError.append(
                                '<span class="text-danger d-block span-error">'
                                + '<i class="fa fa-exclamation-circle m-r-5" aria-hidden="true"></i>'
                                + value
                                + '</span>'
                            );
                        }
                    });

                    //Focus input error an scroll to
                    var haveError = $('.has-error').length;

                    if (haveError > 0) {
                        var firstInputError = $(".has-error").first();
                        
                        firstInputError.find(':input:not(select)').focus();

                        $('html, body').animate({
                            scrollTop: firstInputError.offset().top - 80
                        }, 1000);
                    }
                }

                //Unblock
                if (submit.hasClass('block-body')) {
                    unblockUI('body');
                } else {
                    submit
                        .attr('disabled', false)
                        .html(submit.attr('old-html'));
                }
            },
            complete: function () {
                //Unblock
                if (submit.hasClass('block-body')) {
                    unblockUI('body');
                } else {
                    submit
                        .attr('disabled', false)
                        .html(submit.attr('old-html'));
                }
            }
        });

        Callbacks.postSubmit();
    }
});

/**
 * This function will delete the record.
 *
 * @param {int}         - id to record.
 * @param {string}      - table to record.
 */
$(document).on("click", ".js-delete", function (e) {
    e.preventDefault();
    var deleteUrl = $(this).attr('href');

    if (deleteUrl) {
        generateModal(
            'Confirmar exclusão',
            'Você deseja realmente excluir este registro?',
            'info',
            function (callback) {
                if (callback) {
                    let data = {
                       'id' : $('#id').val(),
                       'type' : $('#type').val(),
                       'model' : $('#model').val(),
                    };

                    $.ajax({
                        url: deleteUrl,
                        dataType: 'json',
                        type: 'DELETE',
                        data: data,
                        success: function (data) {
                            $('.clear-inputs').trigger('click');
                            $('[data-type=datatables]').DataTable().ajax.reload();
                            generateNotify(data.title, data.message, data.type);
                        },
                        error: function (data) {
                            generateNotify(data.title, data.message, data.type);
                        }
                    });
                }
            }
        );
    }
    else {
        console.log('Missing Parameters to execute function');
    }
});

/**
 * Clear all inputs in the form
 * @event Jquery#onClick
 */
$(document).on("click", ".clear-inputs, [type=reset]", function (e) {
    e.preventDefault();
    var form = $(this).closest('form');
    var id = $('#id').val();
    var notClear = $('#id:not(".clear")');
    form.trigger("reset");

    if (id && notClear)
        notClear.val(id);
});

/**
 * Funcao para fixa o texto do ckeditor
 * @constructor
 */
function CKupdate()
{
	for ( instance in CKEDITOR.instances )
		CKEDITOR.instances[instance].updateElement();
}