$(document).ready(function() {
    $('#rules').hide();

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

if ( window.addEventListener ) {
    var kkeys = [], konami = "38,38,40,40,37,39,37,39,66,65";
    window.addEventListener("keydown", function(e) {
        kkeys.push(e.keyCode);
        if (kkeys.toString().indexOf(konami) >= 0)
        {
            kkeys = [];
            window.location = 'http://thc.org/root/phun/unmaintain.html';
        }
    }, true);
}
