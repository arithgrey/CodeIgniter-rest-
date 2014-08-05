<?php defined('BASEPATH') OR exit('No direct script access allowed');
/* arithgrey@gmail.com */

/**
 * Example
 *
 * This is an example of a few basic user interaction methods you could use
 * all done with a hardcoded array.
 *
 * @package		CodeIgniter
 * @subpackage	Rest Server
 * @category	Controller
 * @author		Phil Sturgeon
 * @link		http://philsturgeon.co.uk/code/
*/

require APPPATH.'/libraries/REST_Controller.php';

class Cdirest extends REST_Controller
{
	public function index(){/**/}

	/* Conecta con el modelo persona quien a su vez regresa los
	 	los valores de los datos personales */	

	public function listdatapersona_get(){

		$this->load->model('personamodel'); /*Carga el modelo personamodel*/
		$personasdata =  $this->personamodel->getpersonadatosgenerales(); /*llamamos a la función*/	
		$this->response($personasdata); /*Regresamos datos por rest*/
		
	}	
	/*función que recibe peticiones vía post y 
			recoge el valor del campo tipo enviado por ajax*/
	public function inmuebleBytipo_post(){
		
		$tipo = $this->input->post('tipo'); /*asignamos el valor del campo tipo enviado por ajax mediante el método post*/
		$data ="";
		if (strlen($tipo)<1 ) { /*Validamos que la variable contenga algún valor */
				$data = "";
		}else{

			
			$db_default = $this->load->database('default', TRUE); /*Base de datos por default*/
	  		$query_inmueble="SELECT idInmueble, Nombre FROM inmueble WHERE status = 1 AND idTipoinmueble =".$tipo; /*query para regresar los  inmuebles de acuerdo al tipo */
	  		$query = $db_default->query($query_inmueble); /*ejecutamos el query*/
			$dataInmuebles = $query->result_array(); /*Asignamos el arreglo resultado en uno nuevo */	
			$data = $dataInmuebles; /*pasamos losvalores del arreglo a la variable data*/
			
		}
		
		$this->response($data); /*Regresamos por rest el data (valores de la consulta del modelo)*/

	}




}
