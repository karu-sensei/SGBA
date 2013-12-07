
<?php 

	require "../conexion/conexion.php";
	class consulta{
		var $conn;
		var $conexion;
		function consulta(){		
			$this->conexion= new  Conexion();				
			$this->conn=$this->conexion->conectarse();
		}	
		//-----------------------------------------------------------------------------------------------------------------------
		function registrarUsuario($nombres, $apellidos, $telefono, $ciudad){
			$exito="";
			$sql_insert="insert into usuarios (nombres, apellidos, telefono, ciudad) values ('".$nombres."','".$apellidos."','".$telefono."','".$ciudad."')";
			$rs=pg_query($this->conn,$sql_insert) or die(pg_result_error());
			if($rs){
				$exito="Registro exitoso";
			}
			return $exito;
		}		
		//-----------------------------------------------------------------------------------------------------------------------
		function informeInventario(){			
			$html="";
			$sql="select * from materiales";
			$rs=pg_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe de Inventario</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>C&oacute;digo</td>
            <td>Titulo</td>
            <td>Autor</td>
            <td>Volumen</td>
            <td>A&ntilde;o</td>
            <td>Edicion</td>
            <td>Editorial</td>
            <td>Tipo</td>
            <td>Tomo</td>
            <td>Ejemplares</td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["codigo"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td><td>';
                $html = $html. $row["autor"];
                $html = $html.'</td><td>';
                $html = $html. $row["volumen"];
                $html = $html.'</td><td>';
                $html = $html. $row["anio"];
                $html = $html.'</td><td>';
                $html = $html. $row["edicion"];
                $html = $html.'</td><td>';
                $html = $html. $row["editorial"];
                $html = $html.'</td><td>';
                $html = $html. $row["tipo_material_nombre"];
                $html = $html.'</td><td>';
                $html = $html. $row["tomo"];
                $html = $html.'</td><td>';
                $html = $html. $row["estado"];//realizar count
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-----------------------------------------------------------------------------------------------------------------------	
			function informeMorosos(){			
			$html="";
			$sql="select * from prestamos p, usuarios u,materiales ma,multas m 
                where m.id = p.multas_id and 
                p.usuarios_rut=u.rut and
                ma.id=p.materiales_id";
			$rs=pg_query($this->conn,$sql);
			$i=0;

            $html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe de Usuarios Morosos</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>Rut</td>
            <td>Nombre</td>
            <td>carrera</td>
            <td>Email</td>
            <td>Telefono</td>
            <td>Tiempo morosidad</td>
            <td>Cod. Documento</td>
            <td>Tit. Documento</td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["rut"];
                $html = $html.'</td><td>';
                $html = $html. $row["nombre"];
                $html = $html.'</td><td>';
                $html = $html. $row["carreras_nombre"];
                $html = $html.'</td><td>';
                $html = $html. $row["mail"];
                $html = $html.'</td><td>';
                $html = $html. $row["telefono"];
                $html = $html.'</td><td>';
                $html = $html. $row["dias_atraso"];
                $html = $html.'</td><td>';
                $html = $html. $row["materiales_id"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//------------------------------------------------------------------------------------------
		function informeMatpres(){			
			$html="";
			$sql="select * from prestamos p, materiales m, usuarios u where
            p.usuarios_rut=u.rut and
            m.id=p.materiales_id and m.estado='prestado'";
			$rs=pg_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe de Material en Prestamo</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>Cod. Documento</td>
            <td>Tit. Documento</td>
            <td>Autor</td>
            <td>F. Inicio</td>
            <td>F. Fin</td>
            <td>Rut</td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["materiales_id"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td><td>';
                $html = $html. $row["autor"];
                $html = $html.'</td><td>';
                $html = $html. $row["fecha_inicio"];
                $html = $html.'</td><td>';
                $html = $html. $row["fecha_termino"];
                $html = $html.'</td><td>';
                $html = $html. $row["rut"];
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-------------------------------------------------------------------------------------
		function informeHistorico(){			
			$html="";
			$sql="select * from materiales";
			$rs=pg_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe Historico de Compras</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>F. Recepcion</td>
            <td>Cod. Documento</td>
            <td>Tit. Documento</td>
            <td>Autor</td>
            <td>Volumen</td>
            <td>A&ntilde;o</td>
            <td>Edicion</td>
            <td>Editorial</td>
            <td>Tipo</td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["fecha_recepcion"];
                $html = $html.'</td><td>';
                $html = $html. $row["codigo"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td><td>';
                $html = $html. $row["autor"];
                $html = $html.'</td><td>';
                $html = $html. $row["volumen"];
                $html = $html.'</td><td>';
                $html = $html. $row["anio"];
                $html = $html.'</td><td>';
                $html = $html. $row["edicion"];
                $html = $html.'</td><td>';
                $html = $html. $row["editorial"];
                $html = $html.'</td><td>';
                $html = $html. $row["tipo_material_nombre"];
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-------------------------------------------------------------------------------------
			function informeMatsol(){			
			$html="";
			$sql="select * from materiales";
			$rs=pg_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe Material mas Solicitado</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>C&oacute;digo</td>
            <td>Titulo</td>
            <td>Autor</td>
            <td>Volumen</td>
            <td>A&ntilde;o</td>
            <td>Edicion</td>
            <td>Editorial</td>
            <td>Tipo</td>
            <td>Tomo</td>
            <td>Nro. Prestamos</font></td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["codigo"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td><td>';
                $html = $html. $row["autor"];
                $html = $html.'</td><td>';
                $html = $html. $row["volumen"];
                $html = $html.'</td><td>';
                $html = $html. $row["anio"];
                $html = $html.'</td><td>';
                $html = $html. $row["edicion"];
                $html = $html.'</td><td>';
                $html = $html. $row["editorial"];
                $html = $html.'</td><td>';
                $html = $html. $row["tipo_material_nombre"];
                $html = $html.'</td><td>';
                $html = $html. $row["tomo"];
                $html = $html.'</td><td>';
                $html = $html. $row["estado"];//realizar count
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-------------------------------------------------------------------------------------
		function informeMatsug(){	
			$a=rand(1,1000); 		
			$html="";
			$sql="select * from encuestas";
			$rs=pg_query($this->conn,$sql);
			$i=0;

			$html=$html.'<div align="right"><img src="/SGB2/public/img/logo2.png" width="90px" height="100px" ></div>
                        <br><br><font align="left">Fecha:</font> &nbsp;';
            $html=$html.date('d').'/';
            $html=$html.date('m').'/';
            $html=$html.date('Y');
            $html=$html.'<br><div align="center">
            <font size="12"><u>Informe de encuesta</u></font>
            <br><br><br>           
            <table border="0.5" bordercolor="#707070" class="table">';    
            $html=$html.'<tr bgcolor="#DFDFDF">
            <td>C&oacute;digo</td>
            <td>Titulo</td>
            <td>Autor</td>
            <td>Volumen</td>
            <td>A&ntilde;o</td>
            <td>Edicion</td>
            <td>Editorial</td>
            <td>Tipo</td>
            <td>Cantidad de veces solicitado</font></td></tr>';
			while ($row = pg_fetch_array($rs)){
				$html=$html.'<tr>';
				$html = $html.'<td>';
                $html = $html. $row["id"];
                $html = $html.'</td><td>';
                $html = $html. $row["titulo"];
                $html = $html.'</td><td>';
                $html = $html. $row["autor"];
                $html = $html.'</td><td>';
                $html = $html. $row["volumen"];
                $html = $html.'</td><td>';
                $html = $html. $row["anio"];
                $html = $html.'</td><td>';
                $html = $html. $row["edicion"];
                $html = $html.'</td><td>';
                $html = $html. $row["editorial"];
                $html = $html.'</td><td>';
                $html = $html. $row["tipo"];
                $html = $html.'</td><td>';
                $html = $html. $a;//realizar count
                $html = $html.'</td></tr>';     
                $i++;
			}			
			$html=$html.'</table></div>';			
     		 return ($html);
		}
		//-------------------------------------------------------------------------------------
	}
	

?>

