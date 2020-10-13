<?php

require_once '../app/config/Conexion.php';
class Transaccion extends Conexion {

    public function __construct(){
        $this->conectar=parent::abrirConexion();
        
    }
    
    private $conectar;
    private $tabla = "transacciones";

    public $returnData = [];

    public function msg($success,$status,$message,$extra=[] ){

        return array_merge([
            'success'=>$success,
            'status'=>$status,
            'message'=>$message
        ],$extra);
    }


    public function listar(){
		
		try{
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
			$consulta="SELECT P.ID_PRESUPUESTO, P.MONTO_INICIAL,P.MONTO_ACTUAL,P.PORCENTAJE_EJECUTADO, C.DESCRIPCION ,C.ID_CATEGORIA FROM presupuesto as P INNER JOIN categoria as c 
                        ON  P.ID_CATEGORIA= C.ID_CATEGORIA ";
			$sentencia=$this->conectar->prepare($consulta);
			
			if($sentencia->execute()){
				$res=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			    $rows=count($res);
				
				if($rows > 0 ){

					//var_dump($res);		
					echo json_encode( $res);

					//$returnData=$this->msg(1,202,'DA');
					
				}else{ 
					$returnData=$this->msg(1,204,'No se encontro ningun dato');
					
				}

			}else{
				$returnData=$this->msg(0,500,'Ocurrio un error al consltar datos ');
				
				//$msg['message']='Ocurrio un error al consltar datos';
				
			}

			//$res=$sentencia->fetchAll();
			
		}catch(PDOException $ex ){
			$returnData=$this->msg(0,500,'Ocurrio un error :'.$ex->getMessage());
					
			//$msg['message']="Error al listar usuraios ";
		}

		//return json_encode($returnData);	
	}
    public function guardar( $data ){
		
		try{
			
			//parent::set_names();
			$consulta="INSERT INTO ".$this->db_tabla." (NOMBRES,APELLIDOS,EMAIL,CONTRASEÑA,SEXO,DUI,ESTADO,TELEFONO,FECHA_CREACION) values (?,?,?,?,?,?,?,?,now() )";
			

			if( isset($data->nombre) && isset($data->apellido) && isset($data->telefono )  &&
			 	isset($data->email)  && isset($data->dui) && isset($data->sexo) )
			{				
				

				if(!empty(trim($data->nombre))  &&  !empty(trim($data->apellido))  && !empty(trim($data->telefono)) &&
				!empty(trim($data->email))      &&  !empty(trim($data->password1))  )
				{
					
				$this->nombre=$data->nombre;
				$this->apellidos= $data->apellido;
				$this->telefono=$data->telefono;
				$this->email= $data->email;
				$this->dui= $data->dui;
				$this->sexo= (int) $data->sexo;
				//$this->cargo= test_input($data->nombre)
				$this->estado= 3;
				$this->password1=$data->password1;					
				$var=false;
				$var=$this->validar_usuario($data);
				
				if(!filter_var($data->email,FILTER_VALIDATE_EMAIL)){
					$returnData=$this->msg(0,422,'Formato de Email invalido ! ');
			
				}else if( !$var ){
					//$hash=password_hash($this->password2, PASSWORD_BCRYPT);
					$sentencia=$this->conectar->prepare($consulta);
					$sentencia->bindValue(1,$this->nombre);
					$sentencia->bindValue(2,$this->apellidos);
					$sentencia->bindValue(3,$this->email);
					$sentencia->bindValue(4,$this->password1);
					$sentencia->bindValue(5,$this->sexo);
					
										
					if($sentencia->execute()){
						//$msg['message'] = 'Usuario registrado correctamente !' ;
						//return $returnData=$this->msg(1,201,'Usuario registrodo correctamente');
						$_id=$this->buscarUsuarioEmail($data);
						$returnData=[
							'success'=>1,
							'status'=>201,
							'message'=>"Usuario regsitraod correcatmentre",
							'id'=>$_id
						];
						
					}
					else{
						$returnData=$this->msg(0,500,'No se ingresaron datos ');
							
					}
				
				}else{
					$returnData=$this->msg(0,422,'Ingrese un email  diferente ! ');
							
				}
				
				}else{
					$returnData=$this->msg(0,422,'Valores nulos detectados,  completa todo le formulario ');
				}

            }else{
				$returnData=$this->msg(0,422,'Complete todos los campos '); 
				
			}
			
			}catch(PDOException $ex){
				$returnData=$this->msg(0,500,''.$ex->getMessage());
			}

			 return   (object) $returnData;
			 


	}

    
}




?>