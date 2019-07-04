/**********************************************************************************************************************/
/*	Fichero js que se encargará de ordenar las fotos del administrador del restaurante teniendo en cuenta su posición */
/**********************************************************************************************************************/	 	
	var form = document.getElementById('fotos'); // Cogemos el id del formulario y lo almacenamos en la variable 'form'
	var divs= form.getElementsByTagName('div'); // almacenamos los div que contenga dicho formulario

	for(var i=0; i<divs.length;i++){ // los recorremos mediante un iterador 'for'

		var botones = divs[i].getElementsByTagName('a'); // Cogemos cada uno de los enlaces 'a' (subir, bajar) de los divs y lo almacenamos en la variable botones

		// Asignamos dichas variables
		var btn_subir = botones[0]; 
		var btn_bajar = botones[1];

		btn_subir.onclick =function(){ // Al hacer click en el boton subir realizamos la función

			var div =this.parentNode.parentNode; // Con parentNode accedemos al nodo superior 
			var anterior = div.previousSibling; // Recorremos los nodos hermanos anteriores y lo almacenamos en una variable 'anterior'

			if(anterior != null){ // Siempre y cuando podamos ir recorriendo los nodos y sean diferentes de nulo hacemos lo siguiente

				div.parentNode.insertBefore(div,anterior); // A medida que vaya recorriendo nsertamos los elementos en la posición actual

			}
			return false;
		}

		btn_bajar.onclick = function(){ // Al hacer click en el boton subir realizamos la función

			var div = this.parentNode.parentNode; // Con parentNode accedemos al elemento superior en este caso llegamos al formulario
			var siguiente = div.nextSibling; // Recorremos los nodos hermanos superiores y lo almacenamos a una variable 'siguiente'

			if(siguiente != null && siguiente.id != 'guardar_posicion'){ // Siempre y cuando podamos ir recorriendo los nodos, sean diferentes de nulo y sea diferente de la id 'guardar_posicion' hacemos lo siguiente

				div.parentNode.insertBefore(siguiente, div); // A medida que vaya recorriendo nsertamos los elementos en la posición actual

			}
			return false;
		}
	}