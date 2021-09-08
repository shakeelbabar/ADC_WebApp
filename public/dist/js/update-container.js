jQuery(document).ready(function(){
    
    $('.nav li a').click(function(e){
        $('.nav-link.active').removeClass('active');

        $(this).addClass('active');
        if($(this).parent().parent().hasClass('nav-treeview')){
            $('#new-app-link').addClass('active');
        }
    });
    $('#with-new').click(function(){
        jQuery.ajax({
            url:'/withdrawal_case_ajax',
            type:'get',
            success:function(result){
                jQuery('#content-wrapper').html(result);
                window.history.pushState("Details", "Title", "withdrawal-case");
            }
        });
    });
    $('#att-new').click(function(){
        jQuery.ajax({
            url:'/attendance-case',
            type:'get',
            success:function(result){
                jQuery('#content-wrapper').html(result);
                window.history.pushState("Details", "Title", "attendance-case");
            }
        });
    });
    $('#makeup-new').click(function(){
        jQuery.ajax({
            url:'/makeupexam-case',
            type:'get',
            success:function(result){
                jQuery('#content-wrapper').html(result);
                window.history.pushState("Details", "Title", "makeupexam-case");
            }
        });
    });
    $('#dashboard-menu').click(function(){
        jQuery.ajax({
            url:'/dashboard-menu',
            type:'get',
            success:function(result){
                jQuery('#content-wrapper').html(result);
                window.history.pushState("Details", "Title", "dashboard");
            }
        });
    });
});