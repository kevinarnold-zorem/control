<?php 


	/**
	 * 
	 */
	class Mensualidad
	{	
		public static $tablename="mensualidad";
		public static $created_at="NOW()";

		private $con;

		public $pk_mensualidad;
		public $nombre;
		public $comentario;
		public $monto;
		public $fecha_pago_mes;
		public $fk_usuario;
		public $aud_anulado;

		
		function __construct(Connexion $con)
		{
			$this->con=$con;
		}
		//variables
		public function setpkmensualidad($name)
		{
			$this->pk_mensualidad=$this->con->real_escape_string($name);
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
		public function setfechapagomes($name)
		{
			$this->fecha_pago_mes=$this->con->real_escape_string($name);
		}
		public function setfkusuario($name)
		{
			$this->fk_usuario=$this->con->real_escape_string($name);
		}
		public function setaudanulado($name)
		{
			$this->aud_anulado=$this->con->real_escape_string($name);
		}
		
		//selecteds

		public function getAll()
		{
			$query="SELECT * FROM ".self::$tablename." where fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}
		public function getAllByUser($dia)
		{
			$query="SELECT * FROM ".self::$tablename." WHERE fk_usuario=$this->fk_usuario and DAY(fecha_pago_mes)=$dia and aud_anulado='true'";
			$res=$this->con->query($query);

			return $res;

		}

		public function getAllById()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE pk_mensualidad=$this->pk_mensualidad and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

			return $res;

		}
		public function getAllByName()
		{
			$query="SELECT * FROM ".self::$tablename." WHERE nombre='$this->nombre' and fk_usuario=$this->fk_usuario";
			$res=$this->con->query($query);

            return $this->con->affected_rows;            

		}

		//FUNCIONES
		public function insert()
		{	

			$query="INSERT INTO ".self::$tablename." ( `nombre`, `comentario`, `monto`, `fecha_pago_mes`, `created_at`, `fk_usuario`, `aud_anulado`)";

			$query.=" VALUES ('$this->nombre','$this->comentario','$this->monto','$this->fecha_pago_mes',".self::$created_at.",'$this->fk_usuario','$this->aud_anulado')";

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

		
			$query="UPDATE ".self::$tablename."  SET `nombre`='$this->nombre',`comentario`='$this->comentario',`monto`='$this->monto',`fecha_pago_mes`='$this->fecha_pago_mes',`aud_anulado`='$this->aud_anulado'";

			$query.=" WHERE pk_mensualidad='$this->pk_mensualidad' and fk_usuario='$this->fk_usuario'";
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
			$query="DELETE FROM ".self::$tablename." WHERE pk_mensualidad=$this->pk_mensualidad and fk_usuario=$this->fk_usuario";
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