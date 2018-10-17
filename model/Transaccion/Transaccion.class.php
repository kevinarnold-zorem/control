<?php 


	/**
	 * 24/09/2018 estoy inspirado ......
	 */
	class Transaccion
	{	
		public static $tablename="transaccion";
		public static $created_at="NOW()";

		private $con;

		public $pk_transaccion;
		public $iid;
		public $tabla;
		public $monto;
		public $ingreso;
		public $salida;
		public $comentario;
		public $fecha_pago;		
		public $fk_usuario;
		public $imagen;

		
		function __construct(Connexion $con)
		{
			$this->con=$con;
		}
		//variables
		public function setpktransaccion($name)
		{
			$this->pk_transaccion=$this->con->real_escape_string($name);
		}
		public function setiid($name)
		{
			$this->iid=ucwords($this->con->real_escape_string($name));
		}
		public function settabla($name)
		{
			$this->tabla=$this->con->real_escape_string($name);
		}
		public function setmonto($name)
		{
			$this->monto=$this->con->real_escape_string($name);
		}
		public function setingreso($name)
		{
			$this->ingreso=$this->con->real_escape_string($name);
		}
		public function setsalida($name)
		{
			$this->salida=$this->con->real_escape_string($name);
		}
		public function setcomentario($name)
		{
			$this->comentario=$this->con->real_escape_string($name);
		}
		public function setfechapago($name)
		{
			$this->fecha_pago=$this->con->real_escape_string($name);
		}
		public function setfkusuario($name)
		{
			$this->fk_usuario=$this->con->real_escape_string($name);
		}
		public function setimagen($name)
		{
			$this->imagen=$name;
		}
		
		//selecteds

		public function getAllActivate()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE status='activo' and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}

		public function getAllCobrar()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE iid='$this->iid' and tabla='$this->tabla' and fk_usuario='$this->fk_usuario' ORDER BY ".self::$tablename.".created_at  DESC ";
			$res=$this->con->query($query);

			return $res;

		}
		public function validarmensualidad($mes,$año)
		{
			$query="SELECT * FROM ".self::$tablename." WHERE fk_usuario=$this->fk_usuario and MONTH(fecha_pago)=".$mes." and YEAR(fecha_pago)=".$año." and iid=$this->iid and tabla='$this->tabla'";
			$res=$this->con->query($query);

            return $this->con->affected_rows;            
		}

		public function existepagomes($mes,$año)
		{
			$query="SELECT * FROM ".self::$tablename." WHERE fk_usuario=$this->fk_usuario and MONTH(fecha_pago)=".$mes." and YEAR(fecha_pago)=".$año." and iid=$this->iid and tabla='$this->tabla'";
			$res=$this->con->query($query);

            return $this->con->affected_rows;            
		}

		public function getAll()
		{
			$query="SELECT * FROM ".self::$tablename."";
			$res=$this->con->query($query);

			return $res;

		}
		public function getAllById()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE pk_transaccion=$this->pk_transaccion and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}

		//FUNCIONES
		public function insert()
		{	

			$query="INSERT INTO ".self::$tablename." ( `iid`, `tabla`, `monto`, `ingreso`, `salida`, `comentario`, `fecha_pago`, `created_at`, `fk_usuario`,`imagen`)";

			$query.=" VALUES ('$this->iid','$this->tabla','$this->monto','$this->ingreso','$this->salida','$this->comentario','$this->fecha_pago',".self::$created_at.",'$this->fk_usuario','$this->imagen')";

			$this->con->query($query);

			if ( mysqli_error($this->con)) {
				return mysqli_error($this->con);
			}
			else
			{
				return "defaultValue";
			}
	
		}
		public function update()
		{

			$query="UPDATE ".self::$tablename."  SET `nombre`='$this->nombre',`comentario`='$this->comentario',`monto`='$this->monto',`type`='$this->type' WHERE pk_transaccion=$this->pk_transaccion";

			$this->con->query($query);

			if ( mysqli_error($this->con)) {
				return mysqli_error($this->con);
			}
			else
			{
				return "defaultValue";
			}


		}
		public function delete()
		{
			$query="DELETE FROM ".self::$tablename." WHERE pk_transaccion=$this->pk_transaccion";
			$this->con->query($query);

			if ( mysqli_error($this->con)) {
				return mysqli_error($this->con);
			}
			else
			{
				return "defaultValue";
			}

		}

	}
 ?>