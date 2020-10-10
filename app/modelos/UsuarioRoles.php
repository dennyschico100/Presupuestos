<?php

require_once '../app/config/Conexion.php';
class UsuarioRoles extends Conexion {
    
    private $table="USUARIOS_ROLES";
    public  $idUsuario;
    public  $idRol;
    public  $usuarioRol;

    public $returnData=[];

    private $conectar;
    public function __construct(){
        $this->conectar=parent::abrirConexion();
    }

    public function msg($success,$status,$message){
        return array_merge([
            'success'=>$success,
            'status'=>$status,
            'message'=>$message
        ]);
        
    }

    public function asignarRol($_idUsuario,$_rol){

        try{

            $consulta=" INSERT INTO   ".$this->table." (ID_ROL ,ID_USUARIO ) VALUES (?,?)    ";
            
            if( isset($_rol) && isset($_idUsuario)  )
			{				
				
				if(!empty(trim($_rol))  &&  !empty(trim($_idUsuario))  )
				{
                    
                    $this->idUsuario= $_idUsuario;
                    $this->idRol= (int) $_rol;
					//$hash=password_hash($this->password2, PASSWORD_BCRYPT);
					$sentencia=$this->conectar->prepare($consulta);
					$sentencia->bindValue(1,$this->idRol);
					$sentencia->bindValue(2,$this->idUsuario);
                    if($sentencia->execute()){
						//$msg['message'] = 'Usuario registrado correctamente !' ;
						$this->returnData=$this->msg(1,201,'Usuario y Rol registrado  correctamente');
								
					}
					else{
						 $returnData=$this->msg(0,500,'No se ingresaron datos ');
						
					}
                				
					
                    
				}else{
					$returnData=$this->msg(0,422,'Valores nulos detectados,  completa todo le formulario ');
				}

            }else{
				$returnData=$this->msg(0,422,'Complete todos los campos '); 
				
			}
        

        }catch(PDOException $ex){
            
			$returnData = $this->msg(0,500,$ex->getMessage());
        }
        echo json_encode( $this->returnData);

    }

    public function eliminarUsuarioRol($id){
        try{
			
			if(!empty($id) ){
				$consulta="DELETE FROM  ".$this->table." WHERE ID_USUARIO=?    ";
				$this->idUsuario=(int) $id;
				$sentencia=$this->conectar->prepare($consulta);
				$sentencia->bindValue(1,$this->idUsuario);
						
				if($sentencia->execute()){
					//$msg['message'] = 'Usuario registrado correctamente !' ;
                    //$returnData=$this->msg(1,200,'Datos Elminados correctamente');
                    $returnData=[
                        'success'=>1,
                        'status'=>200,
                        'message'=>"Usuario Eliminado correcatmen"
                    ];

				}
				else{
					$returnData=$this->msg(0,500,'Ocurrio un error  ');
					
				}

			}else{
				$returnData=$this->msg(0,500,'ID NO VALDO ');
					
			}
			
			
		}catch(PDOException $ex  ){

			$returnData=$this->msg(0,500,$ex->getMessage());
		}
        
        //echo  json_encode($returnData);
        
	    return   (object) $returnData;
    } 

    public function modificarRol($data){
        try{
			
			//parent::set_names();
			$consulta="UPDATE  ".$this->table."  SET ID_ROL=? where ID_USUARIO = ? ";
	
			if( isset($data->idUsuario) && isset($data->rol) )
			{				
				

				if(!empty(trim($data->idUsuario))  &&  !empty(trim($data->rol))   )
				{
					
            
                $this->idUsuario= $data->idUsuario;
                $this->idRol= (int) $data->rol;
                $sentencia=$this->conectar->prepare($consulta);
                $sentencia->bindValue(1,$this->idRol);
                $sentencia->bindValue(2,$this->idUsuario);							 

                if($sentencia->execute()){
                    //$msg['message'] = 'Usuario registrado correctamente !' ;
                    $returnData=$this->msg(1,201,'Datos Modificado correctamente');
                            
                }
                else{
                    $returnData=$this->msg(0,500,'No se pudo modificar los datos ');
                    
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
            
			echo json_encode($returnData);

    }

    public function obtenerUsuarioRoles(){
        try{
			//$consulta="SELECT *FROM PRODUCTOS  WHERE NOMBRE_PRODUCTO LIKE '%a' ";
            $consulta="
            SELECT U.ID_USUARIO,U.NOMBRES,U.APELLIDOS,U.EMAIL, R.ID_ROL FROM usuarios as U INNER JOIN usuarios_roles as R 
            ON  U.ID_USUARIO= R.ID_USUARIO";        
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
    }
}

?>