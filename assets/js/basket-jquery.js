$(document).ready(function () {
  $(".size_select").click(function () {
    $(".slider").addClass("active");
    $(".select_size").show();
    $(".select_quantity").hide();
  })

  $(".qty_select").click(function () {
    $(".slider").addClass("active");
    $(".select_size").hide();
    $(".select_quantity").show();
  })

  $(".close, .bg_shadow, .button").click(function () {
    $(".slider").removeClass("active");
  })

  $(".select_size .body ul li").click(function () {
    $(".select_size .body ul li").removeClass("active");
    $(this).addClass("active");
    $(".size_select span").text($(this).text());
    $(".slider").removeClass("active");
  })

  $(".select_quantity .body ul li").click(function () {
    $(".select_quantity .body ul li").removeClass("active");
    $(this).addClass("active");
    $(".qty_select span").text($(this).text());
    $(".slider").removeClass("active");
  })
});