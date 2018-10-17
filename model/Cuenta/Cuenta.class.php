<?php 


	/**
	 * 
	 */
	class Cuenta
	{	
		public static $tablename="cobro_pago";
		public static $created_at="NOW()";

		private $con;

		public $pk_cobro_pago;
		public $nombre;
		public $comentario;
		public $monto;
		public $credit;
		public $type;
		public $status;
		public $fk_usuario;

		
		function __construct(Connexion $con)
		{
			$this->con=$con;
		}
		//variables
		public function setpkcobropago($name)
		{
			$this->pk_cobro_pago=$this->con->real_escape_string($name);
		}
		public function setnombre($name)
		{
			$this->nombre=ucwords($this->con->real_escape_string($name));
		}
		public function setcomentario($name)
		{
			$this->comentario=$this->con->real_escape_string($name);
		}
		public function setmonto($name)
		{
			$this->monto=$this->con->real_escape_string($name);
		}
		public function setcredit($name)
		{
			$this->credit=$this->con->real_escape_string($name);
		}
		public function settype($name)
		{
			$this->type=$this->con->real_escape_string($name);
		}
		public function setstatus($name)
		{
			$this->status=$this->con->real_escape_string($name);
		}
		public function setfkusuario($name)
		{
			$this->fk_usuario=$this->con->real_escape_string($name);
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
			$query="SELECT * FROM ".self::$tablename." WHERE type='$this->type' and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}

		public function getAll()
		{
			$query="SELECT * FROM ".self::$tablename."";
			$res=$this->con->query($query);

			return $res;

		}
		public function getAllById()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE pk_cobro_pago=$this->pk_cobro_pago and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}

		//FUNCIONES
		public function insert()
		{	

			$query="INSERT INTO ".self::$tablename." (`nombre`, `comentario`, `monto`, `credit`, `type`, `status`, `fk_usuario`, `created_at`)";

			$query.=" VALUES ('$this->nombre','$this->comentario','$this->monto','$this->credit','$this->type','$this->status','$this->fk_usuario',".self::$created_at.")";

			$this->con->query($query);

			if ( mysqli_error($this->con)) {
				return mysqli_error($this->con);
			}
			else
			{
				return "defaultValue";
			}
	
		}
		public function updateAbonar()
		{

			$query="UPDATE ".self::$tablename."  SET `credit`='$this->credit',`status`='$this->status' WHERE pk_cobro_pago=$this->pk_cobro_pago and fk_usuario=$this->fk_usuario";

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

			$query="UPDATE ".self::$tablename."  SET `nombre`='$this->nombre',`comentario`='$this->comentario',`monto`='$this->monto',`type`='$this->type' WHERE pk_cobro_pago=$this->pk_cobro_pago";

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
			$query="DELETE FROM ".self::$tablename." WHERE pk_cobro_pago=$this->pk_cobro_pago";
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