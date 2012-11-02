jQuery ($) ->

	app =
		
		init : () ->
			this.fancybox();

		fancybox : () ->
			if ( $.fancybox )
				$( '.fancybox' ).click () ->
					$( '.fancybox' ).fancybox(
						href     : $(@).data 'section'
						minWidth : 445
						width    : 445
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