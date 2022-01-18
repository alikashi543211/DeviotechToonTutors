$(document).ready(function () {
    $('#toggle-chat-sidebar').click(function(){
        if($(this).hasClass('toggled'))
        {
            $('.sidepanel').removeClass('chat-sidebar-toggled');
            $('.sidepanel .contacts ul li.contact .wrap .meta').css('display', 'none');
            $('.sidepanel .search').css('display', 'none');
            $('.sidepanel .contacts ul li.contact').css('padding', '6px 0 46px 8px');
            $(this).removeClass('toggled');
            $(this).html('<i class="fa fa-arrow-right"></i>');

            $(this).css('float', 'none');
            $('.sidepanel .search input').css({'width': '100%'});
        }
        else
        {
            $('.sidepanel').addClass('chat-sidebar-toggled');
            $('.sidepanel .contacts ul li.contact .wrap .meta').css('display', 'block');
            $('.sidepanel .search').css('display', 'block');
            $('.sidepanel .contacts ul li.contact').css('padding', '6px 0 6px 8px');
            $(this).addClass('toggled');
            $(this).html('<i class="fa fa-arrow-left"></i>');

            $(this).css('float', 'left');
            $('.sidepanel .search input').css({'width': '80%'});
        }
    });
});
