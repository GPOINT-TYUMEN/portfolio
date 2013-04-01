$(document).ready(function() {
  Cufon.set('fontFamily','DaxlinePro-Bold');
  Cufon.replace('.main .left .bold');
  Cufon.replace('.main .cube .quickly a');
  Cufon.replace('.main .cube .favorably a');
  Cufon.replace('.main .cube .convenient a');
  Cufon.replace('.colum-left .block-presentation a');
  Cufon.replace('.colum-center h2');
  Cufon.replace('.colum-center .block-form h3');
  Cufon.replace('.colum-center .block-comments h3');
  Cufon.replace('.block-program .block-info h3');
  Cufon.replace('.colum-center .block-option h3');
  Cufon.set('fontFamily','DaxlinePro-Regular');
  Cufon.replace('.main .left .regular');
  Cufon.replace('.main .left .button a');
  Cufon.replace('.block-marketing .button a');
  Cufon.replace('.block-news .button a');
  Cufon.replace('.colum-center .block-news .block-form a');
  Cufon.replace('.block-benefits .button a');


  $("#foo").carouFredSel({
  	auto : false,
    items: 1,
  	pagination	: "#foo_pag"
  });
});
