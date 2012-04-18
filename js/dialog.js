$(document).ready(function() {
    $('.rule').hide();

    var qs = window.location.hash;
    if (qs !== '') {
        dialogShow(qs);
    }

    $('#summary a').click(function(e) {
        e.preventDefault();

        var id = $(this).attr('href');
        window.location.hash = id;
        dialogShow(id);
    });

    $('#mask').click(function () {
        dialogClose();
        window.location.hash = '';
    });
});

function dialogShow(ruleId)
{
    overlayShow();
    dialogPopulate(ruleId);
    dialogCenter();
    $('#dialog').show();
}

function dialogCenter()
{
    var height = $(window).height();
    var width = $(window).width();

    $('#dialog').css('top',  height / 2 - $('#dialog').height() / 2);
    $('#dialog').css('left', width / 2 - $('#dialog').width() / 2);
}

function dialogPopulate(ruleId)
{
    $('#dialog').html($(ruleId).html());
}

function dialogClose()
{
    overlayHide();
    $('#dialog').hide();
}

function overlayShow()
{
    $('#mask').css({
        'width': $(window).width(),
        'height': $(document).height(),
    });

    $('#mask').show();
}

function overlayHide()
{
    $('#mask').hide();
}

