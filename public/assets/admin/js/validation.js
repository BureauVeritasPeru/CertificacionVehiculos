
$(document).ready(function() {
	$("select[required=true]").each(function(){

		var t = $(this);

		$( '<input type="hidden" required="true" value="' + t.val() + '"  placeholder="' + t.attr("placeholder") + '" />' ).insertAfter(t);

		t.change(function(){

			$(this).next().val($(this).val());

		});

		

	});

});
