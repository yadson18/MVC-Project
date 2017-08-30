$(document).ready(function(){
	$(".link-login, .link-register").on("click", function(){
		if($(this).attr("class") === "link-register"){
			$("#login-form").hide();
			$("#register-form").show();
			$("#change-form-register").addClass("active");
			$("#change-form-login").removeClass("active");
		}
		if($(this).attr("class") === "link-login"){
			$("#register-form").hide();
			$("#login-form").show();
			$("#change-form-login").addClass("active");
			$("#change-form-register").removeClass("active");
		}
	});

	function getJson(str) {
	    try{
	        var json = JSON.parse(str);
	    	
	    	return json;
	    }
	    catch(e){
	        return false;
	    }
	}

	var User = function(jsonConfig){
		var loginForm, registerForm, selfRef;

		loginForm = jsonConfig["loginForm"];
		registerForm = jsonConfig["registerForm"];
		
		return {
			login: function(button){
				this.sendData({
					method: "login", 
					url: "/User/login",
					formData: $(loginForm).serialize(),
					loginButton: button
				});
			}, 
			message: {
				error: function(messageConfig){
					var html = HtmlMaker();
					$(messageConfig["insertMessageInto"]).empty();
					$(messageConfig["insertMessageInto"]).append(html.div({
						class: "alert alert-danger",
						role: "alert",
						html: [
							html.i({
								class: "fa fa-exclamation-circle",
								"aria-hidden": "true"
							}),
							html.span({
								text: " " + messageConfig["text"]
							})
						]
					}));
				}
			},
			sendData: function(config){
				selfRef = this;

				$.ajax({
					url: config["url"],
					type: "POST",
					data: { dados: config["formData"] },
					complete: function(xhr, status){

						if(status === "success"){
							var jsonResponse = getJson(xhr.responseText);

							if(!jsonResponse){
								console.log("fail");
							}
						}
					},
					error: function(xhr, status, error){
						console.log("fail");
					},
					success: function(result, status){
						if(status === "success"){
							var data = getJson(result);
							
							if(data){
								$(config["loginButton"]).removeAttr("disabled");
								
								if(config["method"] === "login"){
									if(data["loginSuccess"] === true){
										window.location.href = data["redirectTo"];
									}
									else{
										if(data["message"]["type"] === "error"){
											selfRef.message.error({
												insertMessageInto: ".message-box",
												text: data["message"]["text"]
											});
										}
									}
								}
							}
						}
					},
					beforeSend: function(){
						if(config["method"] === "login"){
							$(config["loginButton"]).attr("disabled", "disabled");
						}
					}
				});
			}
		};

	}

	var user = User({
		loginForm: "#login-form"
	});
	$("#button-login").on("click", function(){
		user.login("#button-login");
	});
});