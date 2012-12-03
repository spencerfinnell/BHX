jQuery ($) ->

	app =
		init : () ->
			this.fancybox()
			this.home()
			this.pages()

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

		home : () ->
			if $( '#featured-slider' ).length
				$( '.featured-slider-slides' ).jCarousellite () ->
					btnNext : $( '#featured-slider-navigation .next' )
					btnPrev : $( '#featured-slider-navigation .prev' )

		pages : () ->
			$( 'blockquote' ).each () ->
				$(@).find( 'p' ).prepend( '<span class="quotemark">&#8220;</span>' )

	tripbuilder = 
		init : () ->
			this.filter();

		filter : () ->
			$( '.build-criteria' ).each () ->
				legend = $(@).find 'legend'
				main   = legend.find 'input[type="checkbox"]'
				items  = $(@).find 'li'

				if ! main.is ':checked'
					legend.addClass 'disabled'
					items.addClass 'disabled'
					items.find( 'input[type="checkbox"]' ).attr( 'disabled', 'disabled' )

				main.change () ->
					items.toggleClass 'disabled'
					legend.toggleClass 'disabled'

					items.find( 'input[type="checkbox"]' ).each () ->
						if $(@).prop( 'disabled', true ) then $(@).prop( 'disabled', false ) else $(@).prop( 'disabled', true )
						if $(@).prop( 'checked', true ) then $(@).prop( 'checked', false ) else $(@).prop( 'checked', true )
						
	app.init()
	tripbuilder.init()