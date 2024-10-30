;jQuery(function($) {
	$(document).ready(function() {
		$(".wrap-lupon-media-wpp").each(function() {
			var wrap = $(this);
			wrap.find(".nav-tab").on("click", function(e) {
				e.preventDefault();
				wrap.find(".nav-tab").removeClass("nav-tab-active");
				$(this).addClass("nav-tab-active");
				wrap.find(".tab-content").hide();
				wrap.find(".tab-content-" + $(this).data("index")).show();
			});
		});
	});
});