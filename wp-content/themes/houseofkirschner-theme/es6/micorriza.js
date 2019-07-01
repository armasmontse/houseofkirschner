import {$, w} from './constants'
import modal from './modal'

const slider = $('.slider')
const video = $('video').get(0)

const logoLeft = $('.home__logo--left')
const containerLeft = $('.home__half--left')

const logoRight = $('.home__logo--right')
const containerRight = $('.home__half--right')

const audioStatus = $('#audio-status')

const firstLogo = $('#first-logo')

const nav = $('nav')

var open = {
    left: false,
    right: false,
}

var x = window.matchMedia("(min-width: 768px)")

$(document).ready(function ()  {

    slider.slick({
        autoplaySpeed: 2000,
        fade: true,
        cssEase: 'linear',
        arrows: false,
        pauseOnFocus: false,
        pauseOnHover: false
    })

    mediaQueries(x)
    x.addListener(mediaQueries) // Attach listener function on state changes

})

const openLeft = function () {
    video.play()
    open.left = true
    containerLeft.css('z-index', '10000')
    containerLeft.addClass('open')
}

const closeLeft = function () {
    video.pause()
    open.left = false
    containerLeft.removeClass('open')
    setTimeout(function () {
        containerLeft.css('z-index', '')
    }, 500)
}

const openRight = function () {
    // Hacemos play a la galeria
    slider.slick('slickPlay')
    open.right = true
    containerRight.css('z-index', '10000')
    containerRight.addClass('open')
}

const closeRight = function () {
    // Hacemos pausa a la galeria
    slider.slick('slickPause')
    open.right = false
    containerRight.removeClass('open')
    setTimeout(function () {
        containerRight.css('z-index', '')
    }, 500)
}

// Manejamos el evento click para 'toggle' de audio
containerLeft.click(function () {
    toggleAudio()
})

// Toggle de audio
const toggleAudio = function () {
    video.setMuted(!video.muted)
}

// Seteamos la propiedad muted
video.setMuted = function (muted) {
    this.muted = muted
    updateAudioStatus()
}

// Actualizamos el status del audio
const updateAudioStatus = function () {
    let status = ''
    if(video.muted){
        status = 'AUDIO'
    }
    audioStatus.text(status)
}

function mediaQueries(x) {

    if (x.matches) { // If media query matches (no es mobile.)

        openLeft()

        setTimeout(function() {
            firstLogo.css('opacity', 0)
        }, 3000)

        video.addEventListener('ended', function ()  {

            // Agregamos loop al video.
            video.loop = true
            // Mostramos el logo del lado izquierdo
            logoLeft.css('opacity', 1)
            // Mostramos el nav
            nav.show()
            // Cerramos el lado izquierdo.
            closeLeft()
            // Agregamos eventHandlers
            logoLeft.hover(openLeft, closeLeft)
            logoRight.hover(openRight, closeRight)

            slider.slick('slickFilter', ':not(.mobile)')
            slider.slick('slickPause')

        })

    }else {

        // Agregamos loop al video.
        video.loop = true
        // Ocultamos el logo del centro.
        firstLogo.css('opacity', 0)
        // Mostramos el logo del lado izquierdo
        logoLeft.css('opacity', 1)
        // Ponemos el mute si es mobile.
        video.setMuted(true)
        // Mostramos el nav
        nav.show()

        logoLeft.click(function() {
            if(open.left){
                closeLeft()
            }else {
                openLeft()
            }
        })

        slider.slick('slickUnfilter')
        slider.slick('slickPlay')

    }

}
