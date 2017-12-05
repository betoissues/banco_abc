<?php

class GestionRegistro
{
	//Atributos
	public $nombre="";
	public $apellido="";
	public $cedula="";
	public $telefono="";
	public $usuario="";
	public $password="";
	public $id_cliente="";
	public $id_usuario="";

	public $cedulavalida=true;
	public $uservalido=true;

	public function GestionRegistro($nombre,$apellido,$cedula,$telefono,$usuario,$password)
	{
		$this->nombre=$nombre;
		$this->apellido=$apellido;
		$this->cedula=$cedula;
		$this->telefono=$telefono;
		$this->usuario=$usuario;
		$this->password=$password;
	} //Constructor inicializar variables

	//Metodos

	public function numcuenta() //Funcion para generar un numero de cuenta que no haya sido registrado
	{
		include("conexion.php");

		$parar=false;
		while($parar==false)
		{
			//Generar numero aleatorio
			$numaleatorio=mt_rand(0,999999999);
			$numcuentafinal="";
			//Comprar forma del numero final
			if(strlen($numaleatorio)==9)
			{
				$numcuentafinal='123456'.$numaleatorio.'1';
			}
			else
			{
				$agregar=9-strlen($numaleatorio);
				$agregarceros="";
				for($i=1;$i<=$agregar;$i++)
				{
					$agregarceros=$agregarceros."0";
				}
				$numcuentafinal='123456'.$agregarceros.$numaleatorio.'1';
			}
			//Comprobar que el numero de cuenta no este registrado
			$sql='SELECT id_cuenta FROM cuenta';
			$consulta=$connection->query($sql);
			if($consulta->fetch_assoc()==false)
			{
				$parar=true;
			}
			else
			{
				$sql='SELECT id_cuenta FROM cuenta';
				$consulta=$connection->query($sql);
				while($numcuentas=$consulta->fetch_assoc())
				{
					if($numcuentafinal!=$numcuentas)
					{
						$parar=true;
					}
				}
			}

		}
		$this->id_cuenta=$numcuentafinal;
	}
	public function numcliente() //Funcion para generar un numero de cliente que no haya sido registrado
	{
		include("conexion.php");
		$sql='SELECT id_cliente FROM cliente';
		$consulta=$connection->query($sql);

		$parar=false;
		while($parar==false)
		{
			//Generar numero aleatorio
			$numaleatorio=mt_rand(0,400);

			//Comprobar que el numero de cuenta no este registrado
			if($consulta->fetch_assoc()==false)
			{
				$parar=true;
			}
			else
			{
				while($numclientes = $consulta->fetch_assoc())
				{
					if($numaleatorio!=$numclientes['id_cliente'])
					{
						$parar=true;
					}

				}
			}
		}
		$this->id_cliente=$numaleatorio;
	}
	public function validarcedula() //Funcion para validar la cedula ingresada
	{
		include("conexion.php");
		$sql="SELECT cedula FROM cliente";
		$consulta=$connection->query($sql);

		while($cedulas= $consulta->fetch_assoc())
		{
			if($cedulas['cedula']==$this->cedula)
			{
				$this->cedulavalida=false;
			}

		}
		return $this->cedulavalida;
	}
	public function validarusuario()//Funcion para validar el usuario ingresado
	{
		include("conexion.php");
		$sql="SELECT usuario FROM cuenta";
		$consulta=$connection->query($sql);

		while($cuentas= $consulta->fetch_assoc())
		{
			if($cuentas['usuario']==$this->usuario)
			{
				$this->uservalido=false;
			}

		}
		return $this->uservalido;
	}
	public function registrar()
	{
		include("conexion.php");
		$sql= "INSERT INTO cliente (id_cliente,nombre,apellido,cedula,telefono) VALUES
		('$this->id_cliente','$this->nombre', '$this->apellido','$this->cedula', '$this->telefono')";

		if ($connection->query($sql) === TRUE)
		{

			$sql= "INSERT INTO cuenta (id_cliente,id_cuenta,saldo,usuario,contrasena) VALUES
			('$this->id_cliente','$this->id_cuenta', 100,'$this->usuario','$this->password')";
			$insertar=$connection->query($sql);

			echo $this->validarusuario();
		}
		else
		{
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	} // Funcion para registrar datos en la tabla Cliente y Cuenta //Funcion para registrar
}

class GestionUsuario
{
	//Atributos
	public $id_cuenta="";
	public $numtrans="";

	//Metodos
	public function GestionUsuario($numcuenta)
	{
		$this->id_cuenta=$numcuenta;
	}
	public function getsaldo()
	{
		include("conexion.php");
		$sql="SELECT * FROM  cuenta";
		$consulta=$connection->query($sql);
		while($cuentas=$consulta->fetch_assoc())
		{
			if($cuentas['id_cuenta']=$this->id_cuenta)
			{
				return $cuentas['saldo'];
			}
		}

	}
	public function getnombre()
	{
		include("conexion.php");
		$sql="SELECT * FROM  cliente c, cuenta cu WHERE cu.id_cuenta='$this->id_cuenta' AND c.id_cliente=cu.id_cliente";
		$consulta=$connection->query($sql);
		while($cuentas=$consulta->fetch_assoc())
		{
			if($cuentas['id_cuenta']=$this->id_cuenta)
			{
				$nombrecompleto= $cuentas['nombre']." ".$cuentas['apellido'];
				return $nombrecompleto;
			}
		}
	}

	public function getncuenta()
	{
		return $this->id_cuenta;
	}
	public function num_transaccion()
	{
		include("conexion.php");
		$sql='SELECT id_trans FROM transaccion';
		$consulta=$connection->query($sql);

		$parar=false;
		while($parar==false)
		{
			//Generar numero aleatorio
			$numaleatorio=mt_rand(0,1000);

			//Comprobar que el numero de transaccion no este registrado
			if($consulta->fetch_assoc()==false)
			{
				$parar=true;
			}
			else
			{
				while($numtrans = $consulta->fetch_assoc())
				{
					if($numaleatorio!=$numtrans['id_trans'])
					{
						$parar=true;
					}

				}
			}
		}
		return $numaleatorio;
	}
	public function validarTransferencia($monto)
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$dia_hoy= substr($fecha_actual, 0,10);
		//Verificar transacciones de la fecha de hoy
		$sql="SELECT * FROM transaccion WHERE fecha like '$dia_hoy%' and id_cuenta='$this->id_cuenta' and nombre='Transferencia'";
		$consulta_fecha= $connection->query($sql);
		//Verificar saldo menos monto
		$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$this->id_cuenta'";
		$consulta_saldo=$connection->query($sql);
		$consulta_saldo= $consulta_saldo->fetch_assoc();
		$oportunidades=0;

		while ($registros = $consulta_fecha->fetch_assoc())
		{
			$oportunidades++;
		}

		//Determinar si realizar la transaccion o no
		if($oportunidades>=3)
		{
			return 'limitetransacciones';
		}
		else if(($consulta_saldo['saldo']-$monto)<100)
		{
			return 'menosque100';
		}
		return "go";
	}

	public function oportunidadesTransferencia()
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$dia_hoy= substr($fecha_actual, 0,10);
		//Verificar transacciones de la fecha de hoy
		$sql="SELECT * FROM transaccion WHERE fecha like '$dia_hoy%' and id_cuenta='$this->id_cuenta' and nombre='Transferencia'";
		$consulta_fecha= $connection->query($sql);
		//Verificar saldo menos monto
		$oportunidades=0;

		while ($registros = $consulta_fecha->fetch_assoc())
		{
			$oportunidades++;
		}

		$oportunidadesdisp=3-$oportunidades;
		return $oportunidadesdisp;
	}

	public function validarRetiro($monto)
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$dia_hoy= substr($fecha_actual, 0,10);
		//Verificar transacciones de la fecha de hoy
		$sql="SELECT * FROM transaccion WHERE fecha like '$dia_hoy%' and id_cuenta='$this->id_cuenta' and nombre='Retiro'";
		$consulta_fecha= $connection->query($sql);
		//Verificar saldo menos monto
		$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$this->id_cuenta'";
		$consulta_saldo=$connection->query($sql);
		$consulta_saldo= $consulta_saldo->fetch_assoc();
		$oportunidades=0;

		while ($registros = $consulta_fecha->fetch_assoc())
		{
			$oportunidades++;
		}

		//Determinar si realizar la transaccion o no
		if($oportunidades>=4)
		{
			return 'limitetransacciones';
		}
		else if(($consulta_saldo['saldo']-$monto)<100)
		{
			return 'menosque100';
		}
		return "go";
	}


	public function oportunidadesRetiro()
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$dia_hoy= substr($fecha_actual, 0,10);
		//Verificar transacciones de la fecha de hoy
		$sql="SELECT * FROM transaccion WHERE fecha like '$dia_hoy%' and id_cuenta='$this->id_cuenta' and nombre='Retiro'";
		$consulta_fecha= $connection->query($sql);
		//Verificar saldo menos monto
		$oportunidades=0;

		while ($registros = $consulta_fecha->fetch_assoc())
		{
			$oportunidades++;
		}

		$oportunidadesdisp=4-$oportunidades;
		return $oportunidadesdisp;
	}

	public function depositar($monto) //Transaccion deposito
	{
		include("conexion.php");
		$interes=$monto*0.0125;
		$montofinal= $interes+$monto;
		$fecha_actual = date("Y-m-d h:i:s");
		$numtransaccion= $this->num_transaccion();

		$sql="INSERT INTO transaccion (id_trans,monto,nombre,fecha,id_cuenta) VALUES
		('$numtransaccion','$montofinal','Deposito','$fecha_actual','$this->id_cuenta')";
		if ($connection->query($sql) === TRUE)
		{

			$sql= "INSERT INTO deposito (id_trans,interes) VALUES
			('$numtransaccion','$interes')";
			$insertar=$connection->query($sql);

			$sql = "UPDATE `cuenta` SET `saldo` = '200' WHERE `cuenta`.`id_cuenta` = '$this->id_cuenta'";
			$this->actualizarDeposito($monto);

		}
		else
		{
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	public function transferencia($monto,$numcuenta) //Transaccion Transferencia
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$numtransaccion= $this->num_transaccion();

		$sql="INSERT INTO transaccion (id_trans,monto,nombre,fecha,id_cuenta) VALUES
		('$numtransaccion','$monto','Transferencia','$fecha_actual','$this->id_cuenta')";
		if ($connection->query($sql) === TRUE)
		{
			$sql= "INSERT INTO transferir(id_trans,num_cuenta) VALUES
			('$numtransaccion','$numcuenta')";
			$insertar=$connection->query($sql);

			$this->actualizarTransferencia($monto,$numcuenta);

		}
		else
		{
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	public function retiro($monto)
	{
		include("conexion.php");

		$fecha_actual = date("Y-m-d h:i:s");
		$numtransaccion= $this->num_transaccion();

		$sql="INSERT INTO transaccion (id_trans,monto,nombre,fecha,id_cuenta) VALUES
		('$numtransaccion','$monto','Retiro','$fecha_actual','$this->id_cuenta')";
		if ($connection->query($sql) === TRUE)
		{
			$sql= "INSERT INTO retiro (id_trans) VALUES
			('$numtransaccion')";
			$insertar=$connection->query($sql);
			$this->actualizarRetiro($monto);

		}
		else
		{
			echo "Error: " . $sql . "<br>" . $connection->error;
		}
	}
	public function actualizarDeposito($monto) // Actualizar saldo de la cuenta
	{
		include("conexion.php");
		//Obtener dinero actual
		$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$this->id_cuenta' ";
		$consulta=$connection->query($sql);
		$dinero_actual=$consulta->fetch_assoc();
		$saldofinal=$dinero_actual['saldo']+$monto;
		//Ingresar dinero nuevo
		$sql = "UPDATE `cuenta` SET `saldo` = '$saldofinal' WHERE `cuenta`.`id_cuenta` = '$this->id_cuenta'";
		$consulta=$connection->query($sql);
	}
	public function actualizarTransferencia($monto,$numcuenta) // Actualizar saldo de las cuentas
	{
		include("conexion.php");

		//Restar dinero  a la cuenta actual
		$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$this->id_cuenta' ";
		$consulta=$connection->query($sql);
		$dinero_actual=$consulta->fetch_assoc();
		$saldofinal=$dinero_actual['saldo']-$monto;

		$sql = "UPDATE `cuenta` SET `saldo` = '$saldofinal' WHERE `cuenta`.`id_cuenta` = '$this->id_cuenta'";
		$consulta_act=$connection->query($sql);

		//Si existe en este banco
		$sql="SELECT * FROM cuenta WHERE id_cuenta='$numcuenta'";
		$consulta=$connection->query($sql);

		if(($consulta->fetch_assoc())==true)
		{
			//Ingresar dinero a la cuenta existente
			$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$numcuenta' ";
			$consulta=$connection->query($sql);
			$dinero_actual=$consulta->fetch_assoc();
			$saldofinal=$dinero_actual['saldo']+$monto;

			$sql = "UPDATE `cuenta` SET `saldo` = '$saldofinal' WHERE `cuenta`.`id_cuenta` = '$numcuenta'";
			$consulta=$connection->query($sql);
		}
	}
	public function actualizarRetiro($monto) // Actualizar saldo de la cuenta
	{
		include("conexion.php");
		//Obtener dinero actual
		$sql="SELECT saldo FROM cuenta WHERE id_cuenta='$this->id_cuenta' ";
		$consulta=$connection->query($sql);
		$dinero_actual=$consulta->fetch_assoc();
		$saldofinal=$dinero_actual['saldo']-$monto;
		//Ingresar dinero nuevo
		$sql = "UPDATE `cuenta` SET `saldo` = '$saldofinal' WHERE `cuenta`.`id_cuenta` = '$this->id_cuenta'";
		$consulta=$connection->query($sql);
	}
}

?>
