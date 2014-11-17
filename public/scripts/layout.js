$(document).ready(function () {
    var isBarOpen = true;
    $('#toggleBar').bind('click',function () {
        isBarOpen = !isBarOpen;
        layout.makeBar(isBarOpen);
    });
});

var layout = layout || {};
layout.toggleBar_C = '#toggleBar';

layout.makeBar = function (isBarOpen) {
    var frame = $('.frame_container');

    if(!isBarOpen) {
        //frame.css('left',0)
        frame.animate({
            'left': 0
        },300,'swing',function () {

        });
        return;
    }
    frame.animate({
        'left': 200
    },300,'swing',function () {

    });
    //frame.css('left',200);
};/**
 * Created by danielwu on 11/17/14.
 */
