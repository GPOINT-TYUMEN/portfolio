var order = $("#order"),
  priceQ = $("#priceQuote"),
  liNull = $('.li_null'),
  liEmpty = $('.li_null input');

$(document).ready(function() {
	$('#priceQuote').costEstimatr();

  $(".sidebar").autofix_anything({
    customOffset: false,
    manual: false,
    onlyInContainer: true
  });

  $('input[name=not]').change(function() {
    if($(this).is(":checked")) {
      liNull.hide();
      liEmpty.prop('checked',false);
      $('input[name=form]').val(3000);
      $('input[name=hosting]').val(0);
      $('#ocno').val(750);
    } else {
      liNull.show();
      $('#form_ooo').val(4000);
      $('#form_ip').val(3000);
      $('#hosting_small').val(2000);
      $('#hosting_middle').val(5000);
      $('#ocno').val(9000);
    }
  });
});

function order_show() {
	order.addClass('show-popup');
}

function popup_close() {
  order.removeClass('show-popup')
}

function price() {
	priceQ.toggleClass('open-form');
}