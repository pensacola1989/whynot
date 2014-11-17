$(document).ready(function(){

    $('.tree_item>a').bind('click',function() {
        $('.tree_item').removeClass('open');
        $(this).parents('.tree_item').addClass('open');
        $('.tree_child').removeClass('active');
        $(this).siblings('ul').addClass('active');
        var $target = $(this).siblings('ul');
        $('.tree_item > ul').not('.active').slideUp();
        $target.slideToggle();
    });
    $('.child_item').bind('click',function() {
        $('.child_item').removeClass('active');
        $(this).addClass('active');
    });
    $('.tree_item').hover(
        function () {
            $(this)
                .find('span')
                .removeClass('glyphicon glyphicon-chevron-right')
                .addClass('glyphicon glyphicon-chevron-right')	;
        },function () {
            $(this)
                .find('span')
                .removeClass('glyphicon glyphicon-chevron-right')
                .removeClass('glyphicon glyphicon-chevron-down');
        });

    $('.tree_item').bind('click',function () {
        $(this)
            .find('span')
            .removeClass('glyphicon glyphicon-chevron-right')
            .removeClass('glyphicon glyphicon-chevron-down')
            .addClass('glyphicon glyphicon-chevron-down');

    });
});/**
 * Created by danielwu on 11/17/14.
 */
