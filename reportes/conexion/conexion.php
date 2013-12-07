<?php 
		class Conexion{
			var $ruta;
			var $usuario;
			var $contrasena;
			var $baseDatos;
		
			function Conexion(){
				$this->ruta="localhost"; //
				$this->usuario="user=postgres"; //usuario que tengas definido
				$this->contrasena="password=maft090204"; //contraseña que tengas definidad
				$this->baseDatos="dbname=usuarios"; //base de datos personas, si quieres utilizar otra base de datos solamente cambiala
			}
			
			function conectarse(){		
				//---------------------------TIPO DE CONEXION 1-----------------------------------
				/*$conectarse= mysql_connect($this->ruta,$this->usuario, $this->contrasena) or die(mysql_error()); //conexion al BD				
				if($conectarse){
					mysql_select_db($this->baseDatos);
					return($conectarse);
				}else{	
					return ("Error");
					}*/
				//------------------------TIPO DE CONEXION 2 - RECOMENDADA---------------------------------------------	
				$enlace = pg_connect("host=localhost dbname=sgb_astronomia user=postgres password=maft090204");
				if($enlace){
					//echo "Conexion exitosa";	//si la conexion fue exitosa nos muestra este mensaje como prueba, despues lo puedes poner comentarios de nuevo: //
				}else{
					die('Error de Conexión (' . pg_connect_errno() . ') '.pg_connect_error());
				}
				return($enlace);
				pg_close($enlace); //cierra la conexion a nuestra base de datos, un ounto de seguridad importante.
			}
		}

?>
