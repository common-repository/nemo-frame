/**
 * Wrapper function to safely use $
 */
function nemocubeWrapper( $ ) {
	var nemocube = {

		/**
		 * Main entry point
		 */
		init: function () {
			nemocube.prefix      = 'nemocube_';
			nemocube.templateURL = $( '#template-url' ).val();
			nemocube.ajaxPostURL = $( '#ajax-post-url' ).val();

			nemocube.registerEventHandlers();
		},

		/**
		 * Registers event handlers
		 */
		registerEventHandlers: function () {
			$( '#example-container' ).children( 'a' ).click( nemocube.exampleHandler );
		},

		/**
		 * Example event handler
		 *
		 * @param object event
		 */
		exampleHandler: function ( event ) {
			alert( $( this ).attr( 'href' ) );

			event.preventDefault();
		}
	}; // end nemocube

	$( document ).ready( nemocube.init );

} // end nemocubeWrapper()

nemocubeWrapper( jQuery );
