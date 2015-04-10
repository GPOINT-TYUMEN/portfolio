function scrollBlock(id) {
    var linkId = $("#scroll-"+id);
    $("html, body")
        .stop(true, false)
        .animate({ scrollTop: (linkId.offset().top)-100 }, 1000);
    return false;
}

$("a.scroll").on("click", function(e) {
    var id = e.currentTarget.hash.substr(1);
    e.preventDefault();
    scrollBlock(id);
    $("a.scroll").removeClass("active");
    $(this).addClass("active");
});
