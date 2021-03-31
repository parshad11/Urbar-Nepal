


// JQUERY


$(document).ready(function () {

  // TOP HEADER
  $("#top-header-close").click(function () {

    console.log('dsljkhfjghv')
    $(".top-header").hide();
  });

  //-- Click on QUANTITY
  $(".btn-minus").on("click", function () {
    var now = $(".section > div > input").val();
    if ($.isNumeric(now)) {
      if (parseInt(now) - 1 > 0) { now--; }
      $(".qty-number input").val(now);
    } else {
      $(".qty-number input").val("1");
    }
  })
  $(".btn-plus").on("click", function () {
    var now = $(".qty-number input").val();
    if ($.isNumeric(now)) {
      $(".qty-number input").val(parseInt(now) + 1);
    } else {
      $(".qty-number input").val("1");
    }
  })

});


// BLOG FILTERING
// FILTERING

let $grid = $('.grid').isotope({
  // options
  itemSelector: '.grid-item',
  layoutMode: 'fitRows',

});



$('.blogs-filter button').on("click", function () {
  var value = $(this).attr('data-name');
  console.log('value ->', value);

  $grid.isotope({
    filter: value,
  })

  $(this).siblings('button').removeClass('btn-success')
  console.log('Class Removed from Sibling')

  $(this).addClass('btn-success');
  console.log('Class Added to')

})