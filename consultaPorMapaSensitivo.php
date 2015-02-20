<?php
	include("conexion.php");


	$punta_x=null;
	$punta_y=null;
	if(isset($_GET['punta_x']) && isset($_GET['punta_y']))
	{
		$punta_x=$_GET['punta_x'];
		$punta_y=$_GET['punta_y'];		
	}

	/*if(isset($boton)){
		unset($boton);
		unset ($punta_x);
	}*/
	
	if(!isset($punta_x)){
		print "<html><head>
		<meta http-equiv='content-type' content='text/html; charset=utf8'/>
		<title>Habitats Naturales</title></head>";
		
		print "<BODY BGCOLOR='DBE4FA'>";
		print "<center><a href='index.php'>Menu</a></center>";
		//print "X: $punta_x   ";
		//print "Y: $punta_y";
		print "<form action=".$_SERVER['PHP_SELF'].">
		<center><h2>Seleccione un punto para obtener las coordenadas</h2><br>
		<input type=\"image\" src=\"habitatsColash2.jpg\" name=\"punta\" width=1000 height=500>
		</center></form></BODY></html>";
	}

	else{
		//Conexión con el servidor y base de datos
		$conex = mysql_connect($host,$user,$contrasena)
		or die("Problemas al conectar al servidor: ".mysql_error());
		$bd = mysql_select_db($basedatos) 
		or die("Problemas al conectar a la base de datos: ".mysql_error());	

		//Consulta SQL
		$consulta = "SELECT id_habitat, nom_habitat FROM habitat 
		where ($punta_x between xmin and xmax) and ($punta_y between ymin and ymax)";		

		$resultado = mysql_query($consulta)or die("Problemas en la sentencia: ".mysql_error());
				

		print"<html><head>
			<meta http-equiv='content-type' content='text/html; charset=utf8'/>
			<title>INFORMACIÓN SOBRE LOS ANIMALES DEL HABITAT</title>
			</head>";
			print "<BODY BGCOLOR='DBE4FA'>";

			print "<center><a href='index.php'>Menu</a></center>";
			
			print"<form action=".$_SERVER['PHP_SELF']."><br><br>
					<center><h1>Animales pertenecientes al habitat seleccionada</center></h1><br><br>";
				
				if ($resultado != false) {

					while (($valor = mysql_fetch_array($resultado)))
					{
						
						print"<center>
						<table border= \"2\" width =\"30%\">
						<tr>
						<td width= \"18%\"> <b>ID HABITAT: </b></td>
						<td width= \"34%\"> $valor[id_habitat]</td>
						</tr>
						<tr>
						<td width= \"18%\"> <b> NOMBRE HABITAT: </b> </td>
						<td width= \"34%\"> $valor[nom_habitat]</td>
						</tr>
						<tr>
						<td width= \"18%\"> <b> COORDENADAS: </b> </td>
						<td width= \"34%\"> <b>X:</b> $punta_x, <b>Y:</b> $punta_y</td>
						</tr>						

						</table></center><br>";

						//Consulta SQL para obtener los animales relacionados al habitat seleccionada
						$sql="SELECT codigo,nombre,descripcion,imagen FROM animal WHERE habitat = $valor[id_habitat]";	
						//Ejecutamos la consulta SQL
						$result=mysql_query($sql);						
						print "<TABLE border=1 width=90% align=center>
						<TR>
						<TH width=10%>CODIGO ANIMAL</TH>
						<TH WIDTH=20%>NOMBRE ANIMAL</TH>
						<TH WIDTH=35%>DESCRIPCIÓN</TH>
						<TH WIDTH=20%>IMAGEN</TH>
						</TR>";		

						//ciclo para escribir los datos de la consulta
						while($row=mysql_fetch_array($result)){
							echo"<TR>
							<TD width=10% align=CENTER> $row[codigo]</TD>
							<TD WIDTH=20% align=CENTER> $row[nombre]</TD>
							<TD WIDTH=35%> $row[descripcion]</TD>
							<TD WIDTH=25% align=CENTER> <IMG SRC='obtener_img.php?id=$row[codigo]' width=65%></img> </TD>
							</TR>";
						}	
						print "</table>";	
					}

				}
				print"<center><br><br><input type=\"submit\" name=\"boton\" value=\"REGRESAR\"></center></form></body></html>";
				@mysql_close($conex);
			}
			
	
?>