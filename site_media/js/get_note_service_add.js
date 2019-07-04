	$(function() {
		
		
		$( "#slider-1" ).slider({
			value:5,
			min: 0,
			max: 10,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-1" ).val( ui.value );
			}
		});
		$( "#input-1" ).val( $( "#slider-1" ).slider( "value" ) );
		
		$( "#slider-2" ).slider({
			value:5,
			min: 0,
			max: 10,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-2" ).val( ui.value );
			}
		});
		$( "#input-2" ).val( $( "#slider-2" ).slider( "value" ) );
		
		$( "#slider-3" ).slider({
			value:5,
			min: 0,
			max: 10,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-3" ).val( ui.value );
			}
		});
		$( "#input-3" ).val( $( "#slider-3" ).slider( "value" ) );
		
		$( "#slider-4" ).slider({
			value:5,
			min: 0,
			max: 10,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-4" ).val( ui.value );
			}
		});
		$( "#input-4" ).val( $( "#slider-4" ).slider( "value" ) );
		
		$( "#slider-5" ).slider({
			value:5,
			min: 0,
			max: 10,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-5" ).val( ui.value );
			}
		});
		$( "#input-5" ).val( $( "#slider-5" ).slider( "value" ) );
		
		$( "#slider-6" ).slider({
			value:5,
			min: 0,
			max: 10,
			values: 5,
			step: 1,
			slide: function( event, ui ) {
				$( "#input-6" ).val( ui.value );
			}
		});
		$( "#input-6" ).val(  $( "#slider-6" ).slider( "value" ) );

	});