jQuery ($) ->

	app =
		
		init : () ->
			this.fancybox();

		fancybox : () ->
			if ( $.fancybox )
				$( '.fancybox' ).fancybox(
					minWidth : 445
					width : 445
					padding  : 0
					helpers  : {
						overlay : { 
							css : {
								'background' : 'rgba(245, 245, 245, .85)'
							}
						}
					}
				)

	app.init();