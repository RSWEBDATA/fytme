

$(function() {
    $('#td1h1').hide();
    $('#classId').change(function() {
        selectedOption = $('option:selected', this);
        $('input[name=classname]').val(selectedOption.data('classname'));
        $('textarea[name=classdescription]').val(selectedOption.data('classdescription'));
        $('select[name=wosubcatid]').val(selectedOption.data('wosubcatid'));
        $('select[name=level]').val(selectedOption.data('level'));

        var str = "";
        str = parseInt($(this).val());
        if(str == 0) {
            $('#td1h1').hide();
            $('input[name=classname]').prop('disabled', false);
            $('textarea[name=classdescription]').prop('disabled', false);
            $('select[name=wosubcatid]').prop('disabled', false);
            $('select[name=level]').prop('disabled', false);
        } else {
            $('#td1h1').show();
            $('input[name=classname]').prop('disabled', true);
            $('textarea[name=classdescription]').prop('disabled', true);
            $('select[name=wosubcatid]').prop('disabled', true);
            $('select[name=level]').prop('disabled', true);
        }
    });
});

$(function() {
    $('#td1h2').hide();
    $('#newLocation').change(function() {
        selectedOption2 = $('option:selected', this);
        $('input[name=locationname]').val(selectedOption2.data('locationname'));
        $('input[name=address]').val(selectedOption2.data('address'));
        $('input[name=address2]').val(selectedOption2.data('address2'));
        $('input[name=city]').val(selectedOption2.data('city'));
        $('select[name=state]').val(selectedOption2.data('state'));
        $('input[name=zip]').val(selectedOption2.data('zip'));
        $('input[name=latitude]').val(selectedOption2.data('latitude'));
        $('input[name=longitude]').val(selectedOption2.data('longitude'));

        var str = "";
        str = parseInt($(this).val());
        if (str == 0) {
            $('#td1h2').hide();
            $('input[name=locationname]').prop('disabled', false);
            $('input[name=address]').prop('disabled', false);
            $('input[name=address2]').prop('disabled', false);
            $('input[name=city]').prop('disabled', false);
            $('select[name=state]').prop('disabled', false);
            $('input[name=zip]').prop('disabled', false);
            $('input[name=latitude]').prop('disabled', false);
            $('input[name=longitude]').prop('disabled', false);
        } else {
            $('#td1h2').show();
            $('input[name=locationname]').prop('disabled', true);
            $('input[name=address]').prop('disabled', true);
            $('input[name=address2]').prop('disabled', true);
            $('input[name=city]').prop('disabled', true);
            $('select[name=state]').prop('disabled', true);
            $('input[name=zip]').prop('disabled', true);
            $('input[name=latitude]').prop('disabled', true);
            $('input[name=longitude]').prop('disabled', true);
        }
    });
});

//enable disable dow select boxes
$(function() {
    $(".dp").attr("disabled", true);
    $(".disable").click(function() {
        if ($("input[name=recur]:checked").val() !== "0") {
            $(".dp").attr("disabled", true).prop("checked", false);
        } else {
            $(".dp").attr("disabled", false);
        }
    });
});

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


