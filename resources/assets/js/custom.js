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

$(function () {
	$lightbox = $('body').attr('data-lightbox');
	$("#mdb-lightbox-ui").load($lightbox);
});




new WOW().init();

// Tooltips Initialization
$(function () {
	$('.tip').tooltip()
});

var showMap = $('#map-container').length > 0;

if(showMap)
{
	var coordinates = [
		-47.88739890654654,
		-15.79895569237561
	];
	
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
		center: [
			-47.8771157,
			-15.797289
		],
		layers: [
			{
				"id": "Sindireceita DF",
				"source": "mapbox-streets",
				"source-layer": "water",
				"type": "fill",
				"paint": {
					"fill-color": "#00ffff"
				}
			}
		],
	};
	
	var htmlPopup = '' +
		'<b class="font-15"> Sindireceita - DF</b><br/>' +
		'<span> Delegacia Sindical de Brasília</span><br/>' +
		'<span> Endereço: SCS Qd. 02 Bloco C</span><br/>' +
		'<span> Ed: Serra Dourada | Salas 516/517</span><br/>' +
		'<span> CEP: 70.300-902</span><br/>' +
		'';
	
	mapboxgl.accessToken = 'pk.eyJ1IjoiaHVnb21pbmFyaSIsImEiOiJjamt6cGViMncwd2d4M3FvZTlsbGk3eHhlIn0.gAAmgFOm36d3XUKJx56chw';
	var map = new mapboxgl.Map(config);
	
	
	////////////
	let clickFunc = function (e) {
		map.dragPan.enable();
		map.off('click', clickFunc);
	};
	
	let zoomFunc = function (e) {
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
	var popup = new mapboxgl.Popup({closeButton: false});
	
	// add markers to map
	// var marker = geojson.features[0];
	var el = document.createElement('div');
	var icon = $('body').attr('data-marker');
	
	// create a DOM element for the marker
	el.className = 'marker';
	el.style.background = 'url(' + icon + ') center center no-repeat';
	el.style.width = '50px';
	el.style.height = '50px';
	
	el.addEventListener('mousemove', function(e) {
		var coorde = [
			-47.88739890654654,
			-15.79891
		];
		
		popup.setLngLat(coorde)
			.setHTML(htmlPopup)
			.addTo(map);
	});
	
	el.addEventListener('mouseout', function(e) {
		popup.remove();
	});
	
	// add marker to map
	new mapboxgl.Marker(el)
		.setLngLat(coordinates)
		.addTo(map);
	
	// //Prevent scroll when mouse hover
	// document.querySelector('canvas.mapboxgl-canvas').addEventListener('wheel', (ev) => {
	// 	if (ev.ctrlKey)
	// 		return;
	//
	// 	ev.stopImmediatePropagation()
	// });
	
	
	
	setTimeout(function(){
		$('.mapboxgl-ctrl-bottom-right').remove();
		$('.mapboxgl-ctrl-bottom-left').remove();
	},200);
}



$(document).ready(function (){
	$("#start-navigation").click(function (){
		$('html, body').animate({
			scrollTop: ($("main").offset().top - 116)
		}, 1000);
	});
	
	$(document).scroll(function(){
		var scrollPosition = $(window).height() + $(window).scrollTop();
		var init = $('main').offset().top + 100;
		var limit = $(document).height() - 200;
		
		if(scrollPosition > init && scrollPosition < limit)
			$('#btn-polls').fadeIn();
		else
			$('#btn-polls').fadeOut();
	});
	
	new Swiper ('.campaigns', {
			loop: true,
			slidesPerView: 5,
			grabCursor: true,
			spaceBetween: 50,
			progress: true,
			navigation: {
				nextEl: '.swiper-campaings-right',
				prevEl: '.swiper-campaings-left',
			},
			keyboard: {
				enabled: true,
			},
			autoplay: {
				delay: 3200,
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
				},
			}
		},
	);
});