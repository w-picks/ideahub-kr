$(".detail_tab li").on("click", function () {
  let ind = $(this).index();
  $(this).addClass("on").siblings().removeClass("on");
  $(".detail_content > div").eq(ind).addClass("on").siblings().removeClass("on");
});
