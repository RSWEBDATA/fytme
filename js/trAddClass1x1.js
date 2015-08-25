

//sets amount input in proper currency format.
(function($) {
    $.fn.currencyFormat = function() {
        this.each( function( i ) {
            $(this).change( function( e ){
                if( isNaN( parseFloat( this.value ) ) ) return;
                this.value = parseFloat(this.value).toFixed(2);
            });
        });
        return this; //for chaining
    }
})( jQuery );


$( function() {
    $('.currency').currencyFormat();
});