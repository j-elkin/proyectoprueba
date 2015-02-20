<HTML>
	<HEAD>
		<meta http-equiv="content-type" content="text/html; charset=utf8"/>
		<TITLE>Agregar Animales</TITLE>
		<!--<link href="estilo.css" rel="stylesheet" type="text/css" />-->

	</HEAD>
	<BODY bgcolor="DBE4FA">
		<!--<div id="menu">
			<ul class="est1">-->
				<CENTER><a href="index.php">Menú</a></CENTER>
			

		<h2> <CENTER> Formulario para el registro de animales </CENTER></h1>
			<form action="registrar.php" method="post" enctype="multipart/form-data" name="datos">
				
				<TABLE BORDER=0 align=CENTER bgcolor="">
					<TR>
						<TD><b> Código: </b></TD> <TD> <input type="text" name="codigo" 
							requared pattern="[0-9]*" title="Por favor inserte un valor numerico para el código del animal"/> 
							<?php
								//Para mostrar el codigo que sigue en incremento.
								include("conexion.php");
								$conex = mysql_connect($host,$user,$contrasena) or die("Problemas al conectar al servidor: ".mysql_error());
								mysql_select_db($basedatos) or die("Problemas al conectar a la base de datos: ".mysql_error());	

								$sql="SELECT MAX( codigo ) FROM animal";
								$result = mysql_query($sql) or die("Problemas en la sentencia: ".mysql_error());
								//$result = mysql_fetch_array($result);
								if($row = mysql_fetch_array($result)){
									//trim para eleminar espacios en blanco de la cadena
									$obtenido= trim($row[0]);
								}

								//$obtenido = $result['codigo'];
								echo " (Se recomienda el codigo: ",($obtenido+1),")";
								@mysql_close ($conex);
							?> 
						</TD>
					</TR>
				
				<TR> <TD><b> Nombre: </b></TD> 	<TD> <input type="text" name="nombre"
												required x-moz-errormessage="Por favor ingrese un nombre del animal."/>
											</TD></TR>
				<TR> <TD><b> Descripción: </b></TD> <TD>
												<TEXTAREA name="descripcion" ROWS="6" COLS="38"
													required x-moz-errormessage="Por favor ingrese una descripción del animal."/>
												</TEXTAREA> </TD></TR>
				
				<TR> <TD><b> Habitat: </b></TD> <TD><SELECT name ="habitat">
					<option value= 1> Montañas Rocosas </option>
					<option value= 2> Montañas Nevadas, Paramos </option>
					<option value= 3> Cordilleras </option>
					<option value= 4> Matorrales, arbustos </option>
					<option value= 5> Bosque </option>
					<option value= 6> Selva </option>
					<option value= 7> Pantanos, Lagunas </option>
					<option value= 8> Rios </option>
					<option value= 9> Granja, Zona abierta </option>
					<option value= 10> Desierto </option>
					<option value= 11> Sabánas </option>
					<option value= 12> Praderas </option>
					<option value= 13> Mar, Playas </option>
				</SELECT></TD>	
				<TR> <TD><b> Imagen: </b></TD> 	<TD> <input type="file" name="imagen" /> </TD></TR>

				<TR> <TD> <input type="submit" name="ok" value="Registrar" /> </TD></TR>
				</TABLE>
			</form>

	</BODY>

</HTML>