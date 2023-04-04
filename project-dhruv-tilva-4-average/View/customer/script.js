$(document).ready(function(){
	$(".tab").click(function(){
		$(".tab").removeClass('active');
		$(this).addClass("active");

		$(".content").removeClass("active");
		var index=$(this).index();
		var main=$(".content").eq(index).addClass("active");

	});
});