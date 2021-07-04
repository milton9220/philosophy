;(function($){

    $(document).ready(function(){

        $("#post-formats-select .post-format").on("click",function(){

            if($(this).attr("id")=="post-format-gallery"){
                $("#attachments-gallery").show();
            }
            else{
                $("#attachments-gallery").hide();
            }

        });
        if(philosophy_pf.format!="gallery"){
            $("#attachments-gallery").hide();
        }

    });

})(jQuery);