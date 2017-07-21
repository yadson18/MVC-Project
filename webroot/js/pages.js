$(document).ready(function() {
	function disableButton(button){
		$(button).attr("disabled", "disabled");
	}

	function submitForm(form){
		$(form).submit();
	}

	$(this).on("click", ".browse", function(){
	  var file = $(this).parent().parent().parent().find(".file");
	  file.trigger("click");
	});

	$(this).on("change", ".file", function(){
	  $(this).parent().find(".form-control").val($(this).val().replace(/C:\\fakepath\\/i, ''));
	});

	$(".close").on("click", function(){
		$("#message").empty();
	});

	$("#send-file-btn, #login-btn").on("click", function(){
		if($(".file").val() !== ""){
			submitForm("#form-send-file");
			disableButton("#send-file-btn");
		}
		if(
			($("#form-login input[name=usuario]").val() != "") && 
			($("#form-login input[name=senha]").val() != "")
		){
			submitForm("#form-login");
			disableButton("#login-btn");
		}
	});
});