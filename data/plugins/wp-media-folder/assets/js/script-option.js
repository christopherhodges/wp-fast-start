(function ($) {
    
    bindSelect = function(){
        $('.wpmf-section-title').on('click',function(){
            var title = $(this).data('title');
            if($(this).closest('li').hasClass('open')){
                $('.content_list_'+ title +'').slideUp('fast');
                $(this).closest('li').removeClass('open');
            }else{
                $('.content_list_'+ title +'').slideDown('fast');
                $(this).closest('li').addClass('open')
            }
        });
        
        $('.btngallery').on('click',function(){
            var value = $(this).attr('checked');
            if(value == 'checked'){
                value = 1;
            }else{
                value = 0;
            }
            var $this = $(this);
            $.ajax({
                type: 'POST',
                url : ajaxurl,
                data :  {
                    action : "update_opt",
                    value : value,
                },
                success : function(res){
//                    $('.btngallery').removeClass('active');
//                    if(!$this.hasClass('active')){
//                        $this.addClass('active');
//                    }
                }
            });
            
        });
    }
    
    $(document).ready(bindSelect);
})(jQuery);