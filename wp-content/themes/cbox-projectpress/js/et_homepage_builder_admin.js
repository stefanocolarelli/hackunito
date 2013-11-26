(function($){
	$(document).ready( function(){
		$( '#et_modules' ).sortable( {
			cancel : '.et_delete_module, input, select'
		} );

		$( '#et_modules_select a' ).click( function() {
			$.ajax( {
				type: "POST",
				url: et_hb_options.ajaxurl,
				data:
				{
					action            : 'et_add_module',
					et_hb_nonce       : et_hb_options.et_hb_nonce,
					et_module_type    : $(this).data('type'),
					et_modules_number : ( $('.et_module').length + 1 )
				},
				success: function( data ){
					$( '#et_modules' ).append( data );
				}
			} );

			return false;
		} );

		$( 'body' ).delegate( '.et_delete_module', 'click', function() {
			$(this).closest( '.et_module' ).remove();

			return false;
		} );
	} );
})(jQuery)