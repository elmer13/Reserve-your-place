<?php
	class HtmlEnlace{
		// Definimos los atributos de la clase HtmlEnlace como privados
		private $enlaces=array();
		private $titulos=array();
		private $onclick=array();
		public $_atributs = array(); 

		public function cargarEnlace($en,$tit,$id,$clase,$atributs = array()){ // Agregamos los diferentes enlaces y los guardamos en los arrays 
	
			$this->enlaces[]=$en;
			$this->titulos[]=$tit;
			$this->id=$id;
			$this->clase[]=$clase;
			$this->_atributs[] = $atributs;
		}

		public function mostrarHorizontal(){ // Mostramos los enlaces horizontalmente
			if($this->id!=''){
				echo '<div id='.$this->id.'>';
				echo '<ul>';
				for($f=0;$f<count($this->enlaces);$f++){ // Recorremos los enlaces para agregarle sus diferentes titulos y enlaces 'href'
					echo '<li class="'.$this->clase[$f].'" style="float:left;"><a onclick="'.@$this->_atributs[$f]["onclick"].'"  href="'.$this->enlaces[$f].'" class="'.$this->clase[$f].'">'.$this->titulos[$f].'</a></li>'; //	float:left tiene una influencia importante para que se muestre de esta manera
				}
				echo '</ul>';
				echo '</div>';
			}else{
				echo '<ul>';
				for($f=0;$f<count($this->enlaces);$f++){ // Recorremos los enlaces para agregarle sus diferentes titulos y enlaces 'href'
					echo '<li class="'.$this->clase[$f].'" style="float:left;"><a onclick="'.@$this->_atributs[$f]["onclick"].'" href="'.$this->enlaces[$f].'" class="'.$this->clase[$f].'">'.$this->titulos[$f].'</a></li>'; //	float:left tiene una influencia importante para que se muestre de esta manera
				}
				echo '</ul>';
			}
		}
	  
		public function mostrarVertical(){ // Mostramos los enlaces horizontalmente
			if($this->id!=''){
				echo '<div id='.$this->id.'>';
				echo '<ul>';	
				for($f=0;$f<count($this->enlaces);$f++){ // Recorremos los enlaces para agregarle sus diferentes titulos y enlaces 'href'
					echo '<li class="'.$this->clase[$f].'"><a onclick="'.@$this->_atributs[$f]["onclick"].'"  href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a></li>';
				}
				echo '</ul>';
				echo '</div>';
			}else{
				echo '<ul>';	
				for($f=0;$f<count($this->enlaces);$f++){ // Recorremos los enlaces para agregarle sus diferentes titulos y enlaces 'href'
					echo '<li class="'.$this->clase[$f].'"><a onclick="'.@$this->_atributs[$f]["onclick"].'" href="'.$this->enlaces[$f].'">'.$this->titulos[$f].'</a></li>';
				}
				echo '</ul>';	
			}
		}
	}
?>
