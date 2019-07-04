/*************************************************************************************************************************************/
/*	Fichero js que tratan con DOM los elementos del formulario  para la sección de añadir fotos en el administrador del restaurante  */
/*************************************************************************************************************************************/	 	
var boton = document.getElementById('otra_foto'); // Cogemos la id del elemento seleccionado y lo guardamos en una variable 'boton'
	
	boton.onclick =function(){ // Cuando hagamos click en el 'boton' realizamos lo siguiente

		var div_cont = document.createElement('div'); // Creamos un elemento 'div' contenedor y lo almacenamos en la variable 'div_cont'

		var input1 = document.createElement('input'); // Creamos un elemento 'input' y lo almacenamos en una variable 'input1'
		
		input1.type= 'hidden'; // Asignamos al input el tipo hidden
		input1.name= 'titulo[]'; // Asignamos al input un nombre de tipo array


		var input2 = document.createElement('input'); // Creamos un elemento 'input' y lo almacenamos en una variable 'input2'

		input2.type = 'file'; // Asignamos al input el tipo file
		input2.name = 'FileInput[]'; // Asignamos al input un nombre de tipo array		

		var div= document.getElementById('inputs_file'); // Cogemos el id del elemento y lo almacenamos en un div

		// Incluimos cada elemento dentro del otro 
		div_cont.appendChild(input1);
		div_cont.appendChild(input2);
		div.appendChild(div_cont);		
	}