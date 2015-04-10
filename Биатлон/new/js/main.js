function scrollBlock(id) {
    var linkId = $("#scroll-"+id);
    $("html, body")
        .stop(true, false)
        .animate({ scrollTop: (linkId.offset().top)-130 }, 1000);
    return false;
}

$("a.scroll").on("click", function(e) {
    var id = e.currentTarget.hash.substr(1);
    e.preventDefault();
    scrollBlock(id);
    $("a.scroll").removeClass("active");
    $(this).addClass("active");
});

function close_popup() {
    $('.popup').addClass('hide');
}

function download_game() {
    $('#download').removeClass('hide');
}

function sign_up() {
    $('#signup').removeClass('hide');
}
