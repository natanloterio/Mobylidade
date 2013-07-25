<!DOCTYPE HTML>
<html lang="en-US">
    
 	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<title>nCircle</title> 
	<script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script>
 
	function conectar(){
		var url ="ws://192.168.0.113:9300";
		Android.connect(url);
		alert('chamou o conect. valor do android:'+Android);
	
	}
	
	
   </script>	
		
</head>    

    <body>
		<button id="conectar" onclick="conectar();">Conectar</button>
    </body>

</html>