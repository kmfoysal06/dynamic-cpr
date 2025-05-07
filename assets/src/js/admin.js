jQuery(document).ready(function($) {
    // show hide single post type
    $('.single-post-type').each(function(){
        let fields = $(this).find('.fields-container');
        fields.hide();
    })

    $(document).on("click", ".single-post-type h2", function() {
        const title = $(this).closest("h2");
        const fields = title.closest(".single-post-type").find(".fields-container");
        fields.slideToggle();
        $(this).toggleClass("active")
    })

    $('.kmfdcpr-field .add-row').on("click", function() {
        // add new row
        let placeholderRow = $(".kmfdcpr-admin-container .single-post-type.placeholder");
        const postTypeContainer = $(".kmfdcpr-admin-container .post-types-container")

        let newPostType = placeholderRow.clone(true).removeClass("placeholder").css("display", "");
        postTypeContainer.append(newPostType)

    })

    $('.kmfdcpr-field .save').on("click", function() {
        // process a ajax request to save data
        const postTypeContainer = $(".kmfdcpr-admin-container .post-types-container")
        let postTypesData = [];
        $('.single-post-type').each(function(){
            const postTypeId = $(this).find(".pt input").val();
            const postTypeTitle = $(this).find(".name input").val();
            const postTypePublic = $(this).find(".ip input").val();
            const postTypeAdmin = $(this).find(".su input").val();
            const postTypeSupports = $(this).find(".sup input").val();
            if(!postTypeTitle.length) {
                kmfdcpr_alert("post type name required!")
                return;
            }
            const singlePostType = {
                'id' : postTypeId,
                'title' : postTypeTitle,
                'is_public' : postTypePublic,
                'is_for_admin' : postTypeAdmin,
                'supports' : postTypeSupports
            }
            postTypesData.push(singlePostType)

        })
        console.log(postTypesData)
    })

    function kmfdcpr_alert(text) {
        alert(text)
    }
});
