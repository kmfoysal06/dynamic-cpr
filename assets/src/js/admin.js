jQuery(document).ready(function($) {
    // show hide single post type
    $('.single-post-type').each(function(){
        let title = $(this).find('h2');

        let fields = $(this).find('.fields-container');
        fields.hide();

        title.on('click', function(){
            fields.slideToggle();
            $(this).toggleClass('active');
        });
    })
});
