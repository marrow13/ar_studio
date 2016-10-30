
jQuery(document).ready(function() {

    /*
        Product showcase background
    */
    $('.product-showcase').backstretch('assets/img/backgrounds/1-.jpg');

    /*
        Gallery
    */
    $('.gallery-images .img-wrapper').hover(
        function() {
            $(this).find('.img-background').fadeIn('fast');
        },
        function() {
            $(this).find('.img-background').fadeOut('fast');
        }
    );

    /*
        Gallery prettyPhoto
    */
    $(".gallery-images a[rel^='prettyPhoto']").prettyPhoto({social_tools: false});

    /*
        Show latest tweet
    */
    $(".show-tweet").tweet({
        username: "anli_zaimi",
        join_text: "auto",
        count: 1,
        loading_text: "loading tweet...",
        template: "{text} {time}"
    });

    /*
        Subscription form
    */
    $('form.subscribe').submit(function() {
        var postdata = $('form.subscribe').serialize();
        $.ajax({
            type: 'POST',
            url: 'assets/subscribe.php',
            data: postdata,
            dataType: 'json',
            success: function(json) {
                if(json.valid == 0) {
                    $('form.subscribe input').css('border', '1px solid #f16f35');
                }
                else {
                    var form_height = $('form.subscribe').height();
                    $('form.subscribe input').css('border', '1px solid #fff');
                    $('form.subscribe').hide();
                    $('.product-description').append('<p style="height: ' + form_height + 'px">' + json.message + '</p>');
                }
            }
        });
        return false;
    });



});


