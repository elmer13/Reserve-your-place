/*******************************************************************************************/
/*	Fichero js que se encargará de cargar el mapa de la localización del apartado Contacto */
/*******************************************************************************************/		

var initialize = function() {
			
	//Definimos las diferentes latitud/longitud de cada uno de los puntos
	
	latLng1 = new google.maps.LatLng(41.35579993020589, 2.0773498357076715);
				
	var mapOptions = {
				
		/* --- Opciones iniciales de nuestro mapa ---*/
		
		zoom: 17, // Zoom inicial
		center: new google.maps.LatLng(41.35634593020589, 2.076998357076715), // Posición inicial
						
		/* --- Manejo de los diferentes controles que tendra nuestro mapa ---*/
						
		// Control de los diferentes tipos de mapas y lo posicionamos en el centro abajo del todo
		
		mapTypeControl: true, 
		mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.BOTTOM_CENTER
		},
					
		// Activamos y posicionamos el control de movimiento en el mapa
		
		panControl: true,
		panControlOptions: {
			position: google.maps.ControlPosition.TOP_RIGHT
		},
					
		// Activamos y posicionamos el controlador del zoom
		
		zoomControl: true,
		zoomControlOptions: {
			style: google.maps.ZoomControlStyle.LARGE,
			position: google.maps.ControlPosition.LEFT_CENTER
		},
				
		// Control de la escala para ella activamos y lo posicionamos a la izquierda
		
		scaleControl: true,
		scaleControlOptions: {
			position: google.maps.ControlPosition.TOP_LEFT
		},
				
		// Activamos el control que nos muestra Google Maps a plena calle
		
		streetViewControl: true,
		streetViewControlOptions: {
			position: google.maps.ControlPosition.LEFT_TOP
		}
				
	}
				
	// Creamos el objeto mapa mediante google maps por medio de la id de nuestro div 'map-canvas' 
	
	var map = new google.maps.Map(document.getElementById('map-canvas'),
	mapOptions); // Incluimos todo lo contenido por la función mapOptions dentro del objeto map
				
	// Creación del marcador P1 
	
	var image = 'site_media/img/aqui.png';
	marker = new google.maps.Marker({
		position: latLng1,
		title: 'Punto inicial: Can Vidalet',
		map: map,
		draggable: true,
		icon: image
	});
				
					
	// Inicialización y características de la linea que remarca el camino
		  
	flightPlanCoordinates = [latLng1];
		 
	flightPath = new google.maps.Polyline({
		path: flightPlanCoordinates,
		strokeWeight: 6,
		strokeOpacity: 0.4, 
		strokeColor: '#0000FF'
	});
		 
	flightPath.setMap(map);
			
}

google.maps.event.addDomListener(window, 'load', initialize); // Ejecutamos la función initialize() al cargar la página