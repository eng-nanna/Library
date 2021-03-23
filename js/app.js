$(document).foundation();
// nice scroll
$("html").niceScroll();

$(".mainSlider").slick({
  dots: true,
  infinite: true,
  arrows: true,
  autoplay: true,
  speed: 600,
  slidesToShow: 1,
  centerMode: true,
  variableWidth: true,
  prevArrow: '<span class="slick-prev mainPrevBtn"></span>',
  nextArrow: '<span class="slick-next mainNextBtn"></span>',

});

$('.multiple-items').slick({
  infinite: true,
  slidesToShow: 5,
  autoplay: true,
  autoplaySpeed: 4000,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 900,
      settings: {
        slidesToShow: 4,
        slidesToScroll: 1
      }
    },
    {
    breakpoint: 480,
    settings: {
      slidesToShow: 1,
      slidesToScroll: 1
    }
  }]
});

//book-info Quantaty
$(".book-info .add").click(function (e) {
  e.preventDefault();
  var inputValue = Number($(".book-info input[type='number']").val());
  inputValue = inputValue+1;
  $(".book-info input[type='number']").val(inputValue);
});
$(".book-info .minus").click(function (e) {
  e.preventDefault();
  var inputValue = Number($(".book-info input[type='number']").val());
  if(inputValue > 1 ){
    inputValue -=1;
    $(".book-info input[type='number']").val(inputValue);
  }
});

// Expand Description
$('.expand-toggle').click(function () {
  var toggleText = $(this).find('strong');
  if( toggleText.text() == "Read More" ){
    toggleText.text("Read Less");
  } else if (toggleText.text() == "Read Less") {
    toggleText.text("Read More");
  }
  $('.des-expand').toggleClass('showMoreDes');
});


// ======= Review Stars

var labels = $(".ranks label");
var labelsTitle = $(".ranks .rateTitle");

labels.hover(function(){
  $(this).css("color", "gold")
    .prevUntil().css("color", "gold");
    labelsTitle.html($(this).attr('data-rate'));

}, function(){
    $(this).css("color", "inherit").prevUntil().css("color", "inherit");
    var checkedNum = $("#ranks label.checked").length;
    if (checkedNum === 1){
      labelsTitle.html( $("#ranks label.checked").attr("data-rate") );
    }else{
      labelsTitle.html("");
    }

});

labels.click(function(){
  var labelSelected = $(this);
  // reset label class and input checkbox
  labels.removeClass("rankChecked checked")
    .find("input[type=checkbox]")
    .removeAttr("checked");

  // add checked when label clicked
  labelSelected.find("input[type=checkbox]").attr("checked","checked")
    .parent().addClass("checked");

  // add rankChecked Class
  labelSelected.addClass("rankChecked")
    .removeAttr("style")
    .prevUntil()
    .removeAttr("style").addClass("rankChecked");

});

// ======== Review End

// grid view switcher

$(".data-switch-view").each(function () {
  var switchView = $(this);
  var links = switchView.find(".options a");
  links.click(function () {
    links.removeClass('active');
    $(this).addClass('active');
    if($(this).attr("id") == "switchToList"){
      // List View
      switchView.find(".switch-view").removeClass("medium-3").addClass("medium-6 listView");
    } else if ($(this).attr("id") == "switchToGrid") {
      // Grid View
      switchView.find(".switch-view").removeClass("medium-6 listView").addClass("medium-3");
    }
  });
});