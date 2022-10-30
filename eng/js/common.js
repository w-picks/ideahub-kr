$(document).ready(function () {
  $(".detail_tab li").on("click", function () {
    let ind = $(this).index();
    $(this).addClass("on").siblings().removeClass("on");
    $(".detail_content > div").eq(ind).addClass("on").siblings().removeClass("on");
  });

  let isUrl = window.location.href;
  let urlSplit = isUrl.split("?=");
  let urlSplit2 = Number(urlSplit[1]);
  if (urlSplit2 != NaN) {
    $(".detail_tab li")
      .eq(urlSplit2 - 1)
      .addClass("on")
      .siblings()
      .removeClass("on");
    $(".detail_content > div")
      .eq(urlSplit2 - 1)
      .addClass("on")
      .siblings()
      .removeClass("on");
  }

  $("header nav > ul > li > a").on("click", function (e) {
    if (window.innerWidth < 910) {
      e.preventDefault();
      $(this).siblings(".depth2").slideDown();
      $(this).parent().siblings().find(".depth2").slideUp();
    }
  });

  $("header .hd_btn").on("click", function () {
    if (window.innerWidth < 910) {
      $(this).toggleClass("on");
      $("header nav").toggleClass("on");
    }
  });
  console.log("1111");
});
