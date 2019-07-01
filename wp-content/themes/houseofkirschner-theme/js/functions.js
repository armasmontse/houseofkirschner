/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId])
/******/ 			return installedModules[moduleId].exports;
/******/
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			exports: {},
/******/ 			id: moduleId,
/******/ 			loaded: false
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.loaded = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "./js/";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, exports, __webpack_require__) {

	'use strict';
	
	var _constants = __webpack_require__(3);
	
	var _modal = __webpack_require__(4);
	
	var _modal2 = _interopRequireDefault(_modal);
	
	function _interopRequireDefault(obj) { return obj && obj.__esModule ? obj : { default: obj }; }
	
	var slider = (0, _constants.$)('.slider');
	var video = (0, _constants.$)('video').get(0);
	
	var logoLeft = (0, _constants.$)('.home__logo--left');
	var containerLeft = (0, _constants.$)('.home__half--left');
	
	var logoRight = (0, _constants.$)('.home__logo--right');
	var containerRight = (0, _constants.$)('.home__half--right');
	
	var audioStatus = (0, _constants.$)('#audio-status');
	
	var firstLogo = (0, _constants.$)('#first-logo');
	
	var nav = (0, _constants.$)('nav');
	
	var open = {
	    left: false,
	    right: false
	};
	
	var x = window.matchMedia("(min-width: 768px)");
	
	(0, _constants.$)(document).ready(function () {
	
	    slider.slick({
	        autoplaySpeed: 2000,
	        fade: true,
	        cssEase: 'linear',
	        arrows: false,
	        pauseOnFocus: false,
	        pauseOnHover: false
	    });
	
	    mediaQueries(x);
	    x.addListener(mediaQueries); // Attach listener function on state changes
	});
	
	var openLeft = function openLeft() {
	    video.play();
	    open.left = true;
	    containerLeft.css('z-index', '10000');
	    containerLeft.addClass('open');
	};
	
	var closeLeft = function closeLeft() {
	    video.pause();
	    open.left = false;
	    containerLeft.removeClass('open');
	    setTimeout(function () {
	        containerLeft.css('z-index', '');
	    }, 500);
	};
	
	var openRight = function openRight() {
	    // Hacemos play a la galeria
	    slider.slick('slickPlay');
	    open.right = true;
	    containerRight.css('z-index', '10000');
	    containerRight.addClass('open');
	};
	
	var closeRight = function closeRight() {
	    // Hacemos pausa a la galeria
	    slider.slick('slickPause');
	    open.right = false;
	    containerRight.removeClass('open');
	    setTimeout(function () {
	        containerRight.css('z-index', '');
	    }, 500);
	};
	
	// Manejamos el evento click para 'toggle' de audio
	containerLeft.click(function () {
	    toggleAudio();
	});
	
	// Toggle de audio
	var toggleAudio = function toggleAudio() {
	    video.setMuted(!video.muted);
	};
	
	// Seteamos la propiedad muted
	video.setMuted = function (muted) {
	    this.muted = muted;
	    updateAudioStatus();
	};
	
	// Actualizamos el status del audio
	var updateAudioStatus = function updateAudioStatus() {
	    var status = '';
	    if (video.muted) {
	        status = 'AUDIO';
	    }
	    audioStatus.text(status);
	};
	
	function mediaQueries(x) {
	
	    if (x.matches) {
	        // If media query matches (no es mobile.)
	
	        openLeft();
	
	        setTimeout(function () {
	            firstLogo.css('opacity', 0);
	        }, 3000);
	
	        video.addEventListener('ended', function () {
	
	            // Agregamos loop al video.
	            video.loop = true;
	            // Mostramos el logo del lado izquierdo
	            logoLeft.css('opacity', 1);
	            // Mostramos el nav
	            nav.show();
	            // Cerramos el lado izquierdo.
	            closeLeft();
	            // Agregamos eventHandlers
	            logoLeft.hover(openLeft, closeLeft);
	            logoRight.hover(openRight, closeRight);
	
	            slider.slick('slickFilter', ':not(.mobile)');
	            slider.slick('slickPause');
	        });
	    } else {
	
	        // Agregamos loop al video.
	        video.loop = true;
	        // Ocultamos el logo del centro.
	        firstLogo.css('opacity', 0);
	        // Mostramos el logo del lado izquierdo
	        logoLeft.css('opacity', 1);
	        // Ponemos el mute si es mobile.
	        video.setMuted(true);
	        // Mostramos el nav
	        nav.show();
	
	        logoLeft.click(function () {
	            if (open.left) {
	                closeLeft();
	            } else {
	                openLeft();
	            }
	        });
	
	        slider.slick('slickUnfilter');
	        slider.slick('slickPlay');
	    }
	}

/***/ }),
/* 1 */,
/* 2 */,
/* 3 */
/***/ (function(module, exports) {

	"use strict";
	
	Object.defineProperty(exports, "__esModule", {
	  value: true
	});
	var $ = exports.$ = jQuery;
	var w = exports.w = $(window);

/***/ }),
/* 4 */
/***/ (function(module, exports) {

	'use strict';
	
	$(document).ready(function () {
	
	    $('.open').click(function () {
	        $('#' + $(this).data('target')).css('display', 'flex');
	    });
	
	    $('.close').click(function () {
	        $('.modal').css('display', 'none');
	    });
	});

/***/ })
/******/ ]);
//# sourceMappingURL=functions.js.map