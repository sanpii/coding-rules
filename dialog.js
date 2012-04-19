$(document).ready(function() {
    $('.rules').hide();

    var qs = window.location.hash;
    if (qs !== '') {
        dialogShow(qs);
    }

    $('nav a').click(function(e) {
        e.preventDefault();

        var id = $(this).attr('href');
        window.location.hash = id;
        dialogShow(id);
    });

    $('#dialog').on('hidden', function () {
        window.location.hash = '';
    });
});

function dialogShow(ruleId)
{
    dialogPopulate(ruleId);
    $('#dialog').modal('show');
}

function dialogPopulate(ruleId)
{
    var title = $(ruleId + ' .title').html();
    $('#dialog .title').html(title);

    var description = $(ruleId + ' .description').html();
    $('#dialog .description').html(description);
}

