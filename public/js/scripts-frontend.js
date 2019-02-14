// This code dosen't works on Firefox and IE and works on other browesers.
// $(document).ready(function () {
// 	$('.animated-icon1,.animated-icon3,.animated-icon4').click(function () {
// 		$(this).toggleClass('open');
// 	});
// });

// // Works everywhere
// $(document).ready(function () {
//
// 	// Hide/show animation hamburger function
// 	$('.navbar-toggler').on('click', function () {
//
// 		// Take this line to first hamburger animations
// 		$('.animated-icon1').toggleClass('open');
//
// 		// Take this line to second hamburger animation
// 		$('.animated-icon3').toggleClass('open');
//
// 		// Take this line to third hamburger animation
// 		$('.animated-icon4').toggleClass('open');
// 	});
//
// });
try {
	var PhoneMaskBehavior = function PhoneMaskBehavior(val) {
		return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
	},
	    options = {
		onKeyPress: function onKeyPress(val, e, field, options) {
			field.mask(PhoneMaskBehavior.apply({}, arguments), options);
		}
	};

	$('.tel').mask('(00) 0000-0000');
	$('.cel').mask(PhoneMaskBehavior, options);
} catch (e) {
	console.log('');
}

$(function () {
	$lightbox = $('body').attr('data-lightbox');
	$("#mdb-lightbox-ui").load($lightbox);
});

new WOW().init();

// Tooltips Initialization
$(function () {
	$('.tip').tooltip();
});

var showMap = $('#map-container').length > 0;

if (showMap) {
	var coordinates = [-47.88739890654654, -15.79895569237561];

	var config = {
		container: 'map-container',
		style: 'mapbox://styles/mapbox/light-v9',
		zoom: 12,
		scrollZoom: false,
		dragPan: false,
		minZoom: 3,
		maxZoom: 17,
		attributionControl: false,
		fullScreenControl: true,
		center: [-47.8771157, -15.797289],
		layers: [{
			"id": "Sindireceita DF",
			"source": "mapbox-streets",
			"source-layer": "water",
			"type": "fill",
			"paint": {
				"fill-color": "#00ffff"
			}
		}]
	};

	var htmlPopup = '' + '<b class="font-15"> Sindireceita - DF</b><br/>' + '<span> Delegacia Sindical de Brasília</span><br/>' + '<span> Endereço: SCS Qd. 02 Bloco C</span><br/>' + '<span> Ed: Serra Dourada | Salas 516/517</span><br/>' + '<span> CEP: 70.300-902</span><br/>' + '';

	mapboxgl.accessToken = 'pk.eyJ1IjoiaHVnb21pbmFyaSIsImEiOiJjamt6cGViMncwd2d4M3FvZTlsbGk3eHhlIn0.gAAmgFOm36d3XUKJx56chw';
	var map = new mapboxgl.Map(config);

	////////////
	var clickFunc = function clickFunc(e) {
		map.dragPan.enable();
		map.off('click', clickFunc);
	};

	var zoomFunc = function zoomFunc(e) {
		if (e.source !== 'fitBounds') {
			map.dragPan.enable();
			map.off('zoomend', zoomFunc);
		}
	};

	map.on('click', clickFunc);
	map.on('zoomend', zoomFunc);
	//////////


	map.addControl(new mapboxgl.NavigationControl());
	map.getCanvas().style.cursor = '';
	var popup = new mapboxgl.Popup({ closeButton: false });

	// add markers to map
	// var marker = geojson.features[0];
	var el = document.createElement('div');
	var icon = $('body').attr('data-marker');

	// create a DOM element for the marker
	el.className = 'marker';
	el.style.background = 'url(' + icon + ') center center no-repeat';
	el.style.width = '50px';
	el.style.height = '50px';

	el.addEventListener('mousemove', function (e) {
		var coorde = [-47.88739890654654, -15.79891];

		popup.setLngLat(coorde).setHTML(htmlPopup).addTo(map);
	});

	el.addEventListener('mouseout', function (e) {
		popup.remove();
	});

	// add marker to map
	new mapboxgl.Marker(el).setLngLat(coordinates).addTo(map);

	// //Prevent scroll when mouse hover
	// document.querySelector('canvas.mapboxgl-canvas').addEventListener('wheel', (ev) => {
	// 	if (ev.ctrlKey)
	// 		return;
	//
	// 	ev.stopImmediatePropagation()
	// });


	setTimeout(function () {
		$('.mapboxgl-ctrl-bottom-right').remove();
		$('.mapboxgl-ctrl-bottom-left').remove();
	}, 200);
}

$(document).ready(function () {
	$("#start-navigation").click(function () {
		$('html, body').animate({
			scrollTop: $("main").offset().top - 116
		}, 1000);
	});

	$('.text-content img').removeAttr('style').addClass('img-fluid');

	$(document).scroll(function () {
		var scrollPosition = $(window).height() + $(window).scrollTop();
		var init = $('main').offset().top + 100;
		var limit = $(document).height() - 200;

		if (scrollPosition > init && scrollPosition < limit) $('#btn-polls').fadeIn();else $('#btn-polls').fadeOut();
	});

	new Swiper('.campaigns', {
		loop: true,
		slidesPerView: 5,
		grabCursor: true,
		spaceBetween: 50,
		progress: true,
		navigation: {
			nextEl: '.swiper-campaings-right',
			prevEl: '.swiper-campaings-left'
		},
		keyboard: {
			enabled: true
		},
		autoplay: {
			delay: 3200
		},
		breakpoints: {
			// when window width is <= 320px
			320: {
				slidesPerView: 1,
				spaceBetween: 10
			},
			// when window width is <= 480px
			480: {
				slidesPerView: 2,
				spaceBetween: 20
			},
			// when window width is <= 767px
			767: {
				slidesPerView: 3,
				spaceBetween: 30
			},
			// when window width is <= 992px
			992: {
				slidesPerView: 4,
				spaceBetween: 40
			}
		}
	});
});

/**
 * Function to send the form with ajax.
 */
$(document).on("click", ".js-submit-form", function (e) {
	e.preventDefault();
	var submit = $(this);
	var form = $('form.ajax-form');

	//CLean errors
	$('.form-group').removeClass('has-error').find('span.text-danger').remove();

	if (submit.hasClass('block-body')) {
		blockUI('body');
	} else {
		submit.attr('disabled', true).attr('old-html', submit.html()).html('<i class="fa fa-spin fa-spinner"></i>' + (submit.hasClass('js-submit-icon-only') ? '' : ' Aguarde'));
	}

	//Send form
	$.ajax({
		dataType: 'json',
		type: 'POST',
		url: form.attr("action"),
		data: form.serializeArray(),
		success: function success(data) {
			var original = data.original;

			if (original) data = original;

			if (data.success) {
				if (!!data.message) toastr.success(data.message);

				$('#form-contact').trigger("reset");
				$('.clear-inputs').trigger('click');
			} else {
				if (!!data.message) toastr.error(data.message);
			}
		},
		error: function error(jqXhr, json, errorThrown) {
			//Get errors
			var response = jqXhr.responseJSON;

			if (!!response) {
				response = response.errors;

				//Display errors on inputs
				$.each(response, function (index, value) {
					var input = $('#' + index);

					if (input.length < 1) input = $('[name=' + index + ']');

					var boxError = input.parents('.form-group');
					var type = input.attr('type');

					boxError.addClass('has-error');

					//Inputs Hidden
					if (input.hasClass('hide') || !!input.attr('data-error')) {
						var elementError = input.attr('data-error');

						if (elementError) $(elementError).css('border-color', 'red');
					}

					boxError.append('<span class="text-danger d-block">' + '<i class="fa fa-exclamation-circle m-r-5" aria-hidden="true"></i>' + value + '</span>');
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
				submit.attr('disabled', false).html(submit.attr('old-html'));
			}
		},
		complete: function complete() {
			//Unblock
			if (submit.hasClass('block-body')) {
				unblockUI('body');
			} else {
				submit.attr('disabled', false).html(submit.attr('old-html'));
			}
		}
	});
});

$(document).on("click", ".clickable", function (e) {
	e.preventDefault();

	var link = $(this).attr('data-href');
	window.location = link;
});
