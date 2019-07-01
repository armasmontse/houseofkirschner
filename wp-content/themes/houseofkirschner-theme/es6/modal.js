$(document).ready(function() {

    $('.open').click(function() {
        $('#' + $(this).data('target')).css('display', 'flex')
    })

    $('.close').click(function() {
        $('.modal').css('display', 'none')
    })

})