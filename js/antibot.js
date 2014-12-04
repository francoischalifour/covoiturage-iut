$(function() {
    var longpress = 1000;
    var start;

    $("#pressHuman").on('mousedown', function(e) {
        start = new Date().getTime();
    });

    $("#pressHuman").on('mouseleave', function(e) {
        start = 0;
    });

    $("#pressHuman").on('mouseup', function(e) {
        if (new Date().getTime() >= (start + longpress)) {
            $('#login').removeAttr('disabled');
            $('#pressHuman').removeClass('mdi-action-accessibility').removeClass('btn-primary').removeClass('btn-warning').addClass('mdi-action-done').addClass('btn-success');
            $('#pressHuman').attr('disabled', true);
        } else {
            $('#pressHuman').removeClass('btn-primary').addClass('btn-warning');
        }
    });
});
