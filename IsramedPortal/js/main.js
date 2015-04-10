$(document).ready(function() {
  $('.header a').on('click', function(e) {
    e.preventDefault();
    var $this = $(this),
      tab = $this.attr("href");

    $this.closest('li').addClass("current");
    $this.closest('li').siblings().removeClass("current");

    $this.parents().find(".page").not(tab).removeClass("active");
    $(tab).addClass("active");
  })
})
