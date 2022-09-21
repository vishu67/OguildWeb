;(function($){
    $(document).ready(function() {
    $('.meis-dismissible').on('click',function(){
        $.post(mgelajinfo.ajax_url,{
            action: 'dismissopenot',
            dismiss:1,
            nonce:mgelajinfo.nonce
        },function(data){
           
        });
    });
        


    });
})(jQuery);