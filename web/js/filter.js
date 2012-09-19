$(document).ready(function() {
    jQuery.expr[':'].Contains = function(a, i, m) {
        return (a.textContent || a.innerText || "")
            .toUpperCase().indexOf(m[3].toUpperCase()) >= 0;
    };


    var defaultWidth = $("#search input[type=\"text\"]").css("width");

    $("#search input[type=\"text\"]")
        .focusin(function() {
            $(this).animate({"width": "500px"}, "slow");
        })
        .focusout(function() {
            if ($(this).val() === "") {
                $(this).animate({"width": defaultWidth}, "slow");
            }
        })
        .keyup(function() {
            var filter = $(this).val();
            var list = $("nav ul");

            if(filter) {
                $matches = $(list).find("a:Contains(" + filter + ")").parent();
                $("li a", list).parent().not($matches).slideUp();
                $matches.slideDown();
            }
            else {
                $(list).find("li").slideDown();
            }
        })
        .keydown(function(e) {
            if (e.which == 13) {
                e.preventDefault();
            }
        });
});
