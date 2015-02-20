<HTML>
	<HEAD>
		<meta http-equiv="content-type" content="text/html; charset=utf8"/>
		<TITLE>Eliminar animal</TITLE>

	</HEAD>
	<BODY BGCOLOR="DBE4FA">
		<CENTER><a href="index.php">Menú</a></CENTER>
		<form action="borrar.php" method="post" enctype="multipart/form-data" name="datos">

			<?php
				include("conexion.php");
				$conex=mysql_connect($host,$user,$contrasena) or die("Problemas al conectar al servidor: ".mysql_error());
				mysql_select_db($basedatos) or die("Error: ".mysql_error());

				$sql="SELECT codigo, nombre FROM animal";
				$consulta=mysql_query($sql);
			

				echo "<TABLE align=center>
					<tr>
						<th> Código </th>
						<th> Nombre	</th>
					</tr>";

					 
					while($contenido=mysql_fetch_array($consulta))
					{

						echo "<tr>
						<td> <input type='checkbox' name='cod[]' id='cod' value='$contenido[codigo]' /> $contenido[codigo] </td>
						<td> $contenido[nombre]</td>
						</tr>";
					}
					
					echo "<tr>
					<td><input type='submit' value='Eliminar' /> </td>
					</tr>";

				echo "</TABLE>";
				@mysql_close($conex)
			?>
		</form>
	</BODY>
</HTML>