/**
 * Method that will get address
 * @event Jquery#OnBlur
 */
$(document).on('focusout', 'input.cep', function (ev) {
    var cep = $(this);
    var length = cep.val().length;

    if(length == 9)
    {
        $.ajax({
            url: dev.baseUrl + '/default/get-address',
            type: 'get',
            data: 'cep=' + cep.val(),
            success: function (data) {
                /**
                 * Get inputs elements that will changed.
                 * @type {*|jQuery|HTMLElement}
                 */
                var city = $('select[data-type="city"]');
                var district = $('input[name="district"] , input[data-type="district"] ');
                var address = $('input[name="address"] , input[data-type="address"] ');
                var state = $('select[data-type="state"]');

                //Fill latitude and longitude.
                getCoordsByCep(cep.val());

                if (data.success) {
                    var cityData = data.city;
                    var addressData = data.address;
                    var stateData = data.state;
                    var districtData = data.district || null;

                    // Set value in state
                    state.val(stateData.id).trigger('change');
                    state.parent('.form-group').removeClass('is-empty');
                    state.removeAttr('disabled');

                    // Set value in city
                    city.empty().append('<option value="' + cityData.id + '"> ' + cityData.name + '</option>');
                    city.empty().val(cityData.id).trigger('change');
                    city.parent('.form-group').removeClass('is-empty');
                    city.removeAttr('disabled');

                    // Set Address value
                    address.empty().val(addressData.address);
                    address.parent('.form-group').removeClass('is-empty');

                    // Set District value
                    district.empty().val(districtData.name);
                    district.parent('.form-group').removeClass('is-empty');
                }
                else {
                    address.removeAttr('readonly').val("").parent('.form-group').addClass('is-empty');
                    district.removeAttr('readonly').val("").parent('.form-group').addClass('is-empty');

                    generateNotify('Não foi possível autocompletar o endereço por este CEP, Por favor preencha manualmente.', 'info');

                    if (typeof state.select2 == 'function')
                        state.select2;
                }
            },
            error: function (data) {

            }
        })
    }
});