<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Personamodel extends CI_Model {

   public function __construct()
   {
      parent::__construct();
      
   }
 
  	/*Registrar persona en el sistema*/ 
  	/*Verifica si existe el curp en el sistema*/
  	function existcurp($curp){

      $db_default = $this->load->database('default', TRUE);


  		$query_curp="SELECT CURP FROM Persona WHERE CURP='".$curp."' ";
  		$query = $db_default->query($query_curp);
  	  return $query->num_rows();

  	}

    
    function registroinforacademica($nivel_escolar , $grado, $cicloescolar , $id_persona , $Turno ){

      $db_default = $this->load->database('default', TRUE);
      $status = "1";

      $data_infoacademic =  array(
        'nivel_escolar' => $nivel_escolar,
        'grado' => $grado, 
        'cicloescolar' => $cicloescolar, 
        'id_persona' => $id_persona, 
        'Turno' => $Turno,
        'status' => $status
         );

      return $db_default->insert( 'informacion_academica', $data_infoacademic);       


    }


    /*Registro de contacto*/
    function registrocontacto($correo, $telefono , $telefono_celular, $id_persona){

        $db_default = $this->load->database('default', TRUE);

        $data = array(
         'correo' => $correo ,
         'telefono' => $telefono ,
         'id_persona' =>  $id_persona, 
         'status' => '1',
         'telefono_celular' => $telefono_celular

        );

         return $db_default->insert('contacto', $data); 

    }



  	function registrapersona($Nombre_persona , 
			$Apellido_materno, $Apellido_paterno, $Sexo, $Fecha_nacimiento, 
			 $entidad_nanimiento, $curp , $persona_cartilla_matricula , $lengua_materna,
			 $discapacidad_persona, 
			 $discapacidad_especificacion_persona, $fecha_formada ){


      $db_default = $this->load->database('default', TRUE);
  		
  		$query_insert ="INSERT INTO Persona (nombre_s, apellido_paterno, 
  			apellido_materno, sexo,  fecha_nacimiento, entidad_nacimiento, 
			CURP, cartilla , idlengua, Discapacidad, Especificacion_discapacidad) 

			VALUES ('".$Nombre_persona."' , '". $Apellido_paterno."', '".$Apellido_materno."',
			 '".$Sexo."', '".$fecha_formada."', '".$entidad_nanimiento."', 
			'".$curp."', '".$persona_cartilla_matricula."' , '".$lengua_materna."', 
				'".$discapacidad_persona."', '".$discapacidad_especificacion_persona."')";

  		$query = $db_default->query($query_insert);

  	    return $query;
  	}

    /*Última persona registrada*/

    function getlastpersonareg(){

      $db_default = $this->load->database('default', TRUE);

      $query_ultima_persona="SELECT id_persona FROM Persona ORDER BY id_persona DESC LIMIT 1";
      $query = $db_default->query($query_ultima_persona);
      return $query->result_array();

    }

   /*Función que regresa los datos generales de una persona por default asignamos un limit de 100*/ 
   function getpersonadatosgenerales($limit=100){    
    /*Cargamos la base de datos por default */ 
    $db_default = $this->load->database('default', TRUE);
    
    /*query*/
    $query_data_persona ="SELECT id_persona ,nombre_s, apellido_paterno , apellido_materno, CURP
     FROM Persona ORDER BY id_persona DESC LIMIT ".$limit;
    $query = $db_default->query($query_data_persona);/*ejecutamos query*/
    return $query->result_array();  /*Retornamos el arreglo de datos recogidos de la base de datos*/



   }   
  



}
