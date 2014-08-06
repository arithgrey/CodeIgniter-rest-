
<!--View nuevo para hacer peticiones con ajax a codelgniter rest -->
<section>	
	<script>			
		
		var TiposInmueblesJson = <?=$TiposInmueblesJson?>/*Pasamos una variable de php a una javascript*/					
		/*Llenamos el listado de tipos de albergues */
		var listadoTipoAlbergue = [];
		for (var a in TiposInmueblesJson ) { /*Recorremos nuestra variable */
				
			listadoTipoAlbergue.push( {name:"", id:""} );
			listadoTipoAlbergue[a].name = TiposInmueblesJson[a].titulo; /*LLenamos el nuevo json*/
			listadoTipoAlbergue[a].id = TiposInmueblesJson[a].idTipo_inmueble; /*Creamos el nuevo json*/

		}
        /*Para tipos de inmuebles */
        /*Mandamos llamar componentes de dojo framework */	
         require([	"dojo/store/Memory", "dijit/form/FilteringSelect", "dojo/domReady!"],
        function(Memory, FilteringSelect){
			var stateStore = new Memory( {data : listadoTipoAlbergue} );
			var filteringSelect = new FilteringSelect({
				id: "ListaTiposinmuebles",  /*Creamos un nuevo FilteringSelect*/
				name: "tipoinmuebleid",
				value: "id",
				store: stateStore,
				searchAttr: "name",
				required: true,
				autoComplete: true
			},
			"ListaTiposinmuebles").startup();
			});

    </script>

    <script>
    	/*LLamamos componentes de dojotoolkit*/
    	require( ["dojox/mobile", "dojox/mobile/parser", "dojox/mobile/IconContainer"] );
    </script>


<script type="text/javascript">

var iconos;
$( document ).on('ready', function (){
	
	/*cargamos los datos con ajax */	
	$(".select_Tinmueble").click(function (){
		ListaTiposinmuebles = dijit.byId('ListaTiposinmuebles').get('value');
   		urlinmueble = "<?=base_url()?>index.php/api/cdirest/inmuebleBytipo/tipo/format/json"; /*Url donde se encuentra 
   			nuestro controlador rest */
					$.ajax({ 
			             type: "POST", /*Enviar datos vía post*/
			             url: urlinmueble, /*Asignamos la url */
			             dataType: "json",	/*Pedimos que el formato de regreso sea un objeto json*/
			             data : {"tipo" : ListaTiposinmuebles}, 	/*Enviamos valor vía post */
			             success: function(data){    /*Cuando la respiuesta es correcta ajax regresa el data del rest controller*/
					             	
					             	jsonAlbergues = data; /*pasamos el obj retornado por ajax a una nueva variable*/
					             	var albergue = [];

					             	urlimg = "http://localhost/albergues/application/img/iconos/correcto.png";
					             	imgobj = "<img src="+urlimg+" width='3%' />";
					             	$('.respuestajax').html(imgobj);

									for( var i in jsonAlbergues ){ /*damos formato al nuevo json*/

										albergue.push( {name:"", id:""} );
										albergue[i].name = jsonAlbergues[i].Nombre; /*Asignamos valores a json*/
										albergue[i].id = jsonAlbergues[i].idInmueble; /*Asignamos valores a json*/
									}					           
					             	 require([	"dojo/store/Memory", "dijit/form/FilteringSelect", "dojo/domReady!"],
								        function(Memory, FilteringSelect){
											var stateStore = new Memory( {data : albergue} );
											var filteringSelect = new FilteringSelect({
												id: "Albergues",
												name: "inmuebleid",
												value: "id",
												store: stateStore, 	/*Creamos un componente dinámico de dojo */
												searchAttr: "name",
												required: true,
												autoComplete: true
											},
											"Albergues").startup();
									});			          
				             }
			         });
		
		});

});


</script>
		<form action="<?=base_url()?>index.php/cdi/listctioninmueble" Method ="POST" >			
					<div class='container' id='container'>								
								<?php								
									foreach ($Estados_republica  as $edo ) {
										
									echo "<a><img src='". base_url(). "application/img/cdi.jpg" ."' id='tagid' class='tagid' />	

											<input type='radio' name='edo' class='che_edo' id='che_edo' value= '".$edo['id']."' required />
											<label>".$edo['Estado']."</label>
										</a>";

									}
								?>				
					</div>
					<div class='select_Tinmueble' id='select_Tinmueble'>
						<!--respuestajax-->
						
						<div id='respuestajax' class='respuestajax'></div>
						<label>Tipo de inmueble: 							
							<input id="ListaTiposinmuebles" >							
						</label>
					</div>
					
					<div class='inmueble' id='inmueble'></div>
							<label>Albergue:
							<input id="Albergues"><br>
					</label>	

				<button type='submit'>Siguiente</button>		
		</form>








