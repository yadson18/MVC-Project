<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>Danied Access</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="/css/pages.css">
</head>
<body id="danied-access">
	<div id="content">
        <img src="/img/logo.png">
        <h3>
        	<?= $message ?>
        </h3>
        <p><button id="redirect-button">Click here to make login</button></p>
   	</div>
    <script type="text/javascript">
        window.onload = function(){
            document.getElementById("redirect-button").addEventListener("click", function(){
                window.location.href = "/User/login";
            });
        };
    </script>
</body>
</html>