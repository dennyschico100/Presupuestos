<?php

require_once '../app/config/Conexion.php';
class Usuario extends Conexion{
    public function __construct(){
        $this->conectar=parent::abrirConexion();
        
    }
    private $conectar;
    private $db_tabla = "usuarios";
	public  $nombres="ROBERTO";
    public  $apellidos="ROBERT";
    public  $email="roberto@gmail.com";
    private $password="";
	public $dui="";
	public $sexo=0;	
	public $estado=1;
	
    public $returnData = [];

    public function msg($success,$status,$message,$extra=[] ){

        return array_merge([
            'success'=>$success,
            'status'=>$status,
            'message'=>$message
        ],$extra);
    }

	public function buscarUsuarioEmail($data){
		$res=false;
		try{
			
			if(isset($data) ){
				if(!empty(trim($data) ) ){
                    
					$consulta=" SELECT  count(*)  FROM ".$this->db_tabla." where email =?    " ;
					$sentencia=$this->conectar->prepare($consulta);
					$this->email=$data;
                    
					$sentencia->bindValue(1,$this->email);
					if($sentencia->execute()){
                        
                        $res=$sentencia->fetchAll(\PDO::FETCH_ASSOC);
                        $filas=count($res);
						if(  $filas >= 1 ) {
                            
						//$res=$sentencia->fetchAll();
						//RESPONDIENDO UN OBJETO HACIA EL FRONTEND
						//return json_encode($res);
						//echo "SI HAY REGISTROS";	
						$res=true;

						}else{
							$res=false;
						}

					}else{
						$msg['message']="Ocurrio un error  ";
				
					
					}
						
				}else{
					$msg['message']="Ooops hay campos vacios por favor ingrese su decula o su correo electronico !!";
				
				}
			}else{
				$msg['message']=" Ingrese su decula o su correo electronico !!";
				
			}

	
		}catch(PDOException $ex ){
			 $msg['message']="".$ex->getMessage();
			 echo json_encode($msg);	 
		}

		return $res;

	}

	public function usuarioRol($data){
		
		try{
			$id=$data; 
			$consulta="SELECT *FROM usuarios_roles  where id_usuario =? ";
			$sentencia=$this->conectar->prepare($consulta);
			$sentencia->bindValue(1, $this->id);
			if($sentencia->execute()){
				$res= $sentencia->fetchAll(\PDO::FETCH_ASSOC);
												   
				$rows=count($res);
											
				if(  $rows >= 1 ) {
					//echo json_encode($res);		

					
					if(true){
						$this->returnData = [
							
							'rol' => $res[0]['ID_ROL']
						];

					}else{
						//$this->returnData = $this->msg(0,422,' contraeña incorrecta !');
					}  

				}else{
								
					$this->returnData = $this->msg(0,422,'Usuario y/o  contraeña incorrecta  !');
				}

			}else{

			}
		}catch(PDOException $ex){
			$this->returnData = $this->msg(0,500,$ex->getMessage());
			
		}
		return $this->returnData;
	}

	public function login($data=[]){
		//Decodificando la informacion , que viene en formato JSON
		$data=json_decode($data);
		
		$this->password=$data->password;
		$this->email=$data->email;
		try{
            
			if(isset($data->email ) && isset( $data->password) ){
				if(true){
                    
					$consulta=" SELECT  *FROM ".$this->db_tabla." where email=?  " ;
					$sentencia=$this->conectar->prepare($consulta);

                    //$this->cedula=$this->test_input($this->cedula);
                    
					//$this->email=$this->test_input($this->email);
                
					$sentencia->bindValue(1,$this->email);
					
					if($sentencia->execute()){
                        
                        $res= $sentencia->fetchAll(\PDO::FETCH_ASSOC);
												   
                        $rows=count($res);
                            						
						if(  $rows >= 1 ) {
						   							
                        	$pass['pass'] =$res[0]['CONTRASEÑA'];
							
							$this->id=$res[0]['ID_USUARIO'];
							
							$rol=$this->usuarioRol($this->id);
							

							//echo "".json_encode($res[0]['contraseña']);

                            //$check_password = password_verify($data->password,$pass['pass'] );
							//$res[0]['contraseña']='';

							
                             if($data->password ===  $res[0]['CONTRASEÑA']  ){
								$res[0]['contraseña']='';
								
								$this->returnData = [
                                    'success' => 1,
                                    'status'=> 202,
									'usuario' => $res[0],
									'rol_usuario'=>$rol['rol']
                                ];
							
                            }else{
								$this->returnData = [
                                    'success' => 0,
                                    'status'=> 422
                                ];
							}
							  

						}else{
                            
                    
                            $this->returnData = $this->msg(0,422,'Usuario y/o  contraeña incorrecta  !');
						}

					}else{
						echo $msg['message']="Ocurrio un error  ";

					}
						
				}else{
					echo $msg['message']="Ooops hay campos vacios, complete todos los campos !!";
				
				}
			}else{
			//echo 	$msg['message']=" Ingrese su decula y/o contraseña!!";


			}
            
		}catch(PDOException $ex ){
             //$msg['message']="".$ex->getMessage();
             
            $this->returnData = $this->msg(0,500,$ex->getMessage());
					
             //echo json_encode($msg);
             	 
		}
    
		return $this->returnData;
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
					$sentencia->bindValue(6,$this->dui);
					$sentencia->bindValue(7,$this->estado);
					$sentencia->bindValue(8,$this->telefono);	
										
					if($sentencia->execute()){
						//$msg['message'] = 'Usuario registrado correctamente !' ;
						$returnData=$this->msg(1,201,'Usuario registrodo correctamente'.$this->password1);
								
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
				$returnData=$this->msg(0,422,'complete todos los campos '); 
				
			}
			
			}catch(PDOException $ex){
				$returnData=$this->msg(0,500,''.$ex->getMessage());
			}

			echo json_encode($returnData);
	}

	public function validar_usuario($data){
		$res=false;
		try{
			
			if(isset( $data->email) ){
				if( !empty(trim($data->email))){

					$consulta=" SELECT  *FROM ".$this->db_tabla." where  EMAIL=? " ;
					$sentencia=$this->conectar->prepare($consulta);
					$this->email=$data->email;

					$sentencia->bindValue(1,$this->email);
					
					if($sentencia->execute()){
						$respuesta=$sentencia->fetchAll(PDO::FETCH_ASSOC); 
						$rows=count($respuesta);
						if(  $rows >= 1 ) {
							
						//$res=$sentencia->fetchAll();
						//RESPONDIENDO UN OBJETO HACIA EL FRONTEND
						//return json_encode($res);
						//echo "SI HAY REGISTROS";	
							$res=true;

						}else{

							$res=false;
						}

					}else{
						$msg['message']="Ocurrio un error  ";

					}
						
				}else{
					$msg['message']="Ooops hay campos vacios por favor ingrese su decula o su correo electronico !!";
				
				}
			}else{
				$msg['message']=" Ingrese su decula o su correo electronico !!";
				
			}

	
		}catch(PDOException $ex ){
			 $msg['message']="".$ex->getMessage();
			 echo json_encode($msg);	 
		}

		return $res;

	}


	public function listar(){
		
		try{
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
			$consulta="SELECT * FROM  usuarios ";
			$sentencia=$this->conectar->prepare($consulta);
			
			if($sentencia->execute()){
				$res=$sentencia->fetchAll(PDO::FETCH_ASSOC);
			    $rows=count($res);
				
				if($rows > 0 ){

					//var_dump($res);		
					return $res;

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
	
	public function buscarUsuario($id){

		try{
			$this->id=$id;
			$consulta=" SELECT *FROM ".$this->db_tabla." where id_usuario= ? ";
			$sentencia=$this->conectar->prepare($consulta);
			
			$sentencia->bindValue(1,$this->id);
			if($res=$sentencia->execute()){ 
				//$rows=$sentencia->fetchColumn(); 
				
				$res= $sentencia->fetchAll(\PDO::FETCH_ASSOC);
				$rows =count($res);
				if($rows > 0 ){
					return json_encode($res[0]);	
					
				}else{
						$res=null;
						$returnData=$this->msg(0,422,'No se encontro ningun registro ocn ese ID ');
						
				}
					
			}else{
				
				$msg['message'] = 'ERROR AL CONSULTAR DATOS ';
				$returnData=$this->msg(0,500,'Error al consultar datos');
				//return false;
			}

		}catch( PDOException $ex ){
			//$msg['message'] = 'ERROR  ';
			$returnData=$this->msg(0,422,'No se encontro ningun registro ocn ese ID '.$ex->getMessage());
		
		}

		return $returnData;

	}	
		
		

}



?>