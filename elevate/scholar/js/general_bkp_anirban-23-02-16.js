jQuery( document ).ready( function( $ ) {
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.userAgent) ||
       (/Android|webOS|iPhone|iPad|iPod|BlackBerry/i.test(navigator.platform))) {
        // something will happen here.
    } else {
        // A navigation menu that follows you.
        var pos         = parseInt( $( '#header' ).offset().top );
        var height      = parseInt( $( '#header' ).outerHeight( true ) );

        if ( $(window).width() > 767) {

            $(window).scroll(function() {
                var top = $(document).scrollTop();
                if ( top > pos ){
                    $( '#header' ).addClass( 'fixed' );

                    if ( $( 'body' ).hasClass( 'page-template-template-homepage-php' ) ) {
                        $( '#header-container' ).css( 'padding-top', height + 'px' );
                    } else {
                        $( 'body' ).css( 'padding-top', height + 'px' );
                    }
                } else {
                    $( '#header' ).removeClass('fixed');

                    if ( $( 'body' ).hasClass( 'page-template-template-homepage-php' ) ) {
                        $( '#header-container' ).css( 'padding-top', '0' );
                    } else {
                        $( 'body' ).css( 'padding-top', '0' );
                    }
                }
            });
        }
    }
});