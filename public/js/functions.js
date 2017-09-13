function showMenu(obj) {

    var rect = obj.getBoundingClientRect();
    var childSize = ($(obj).find('.menu_child_1').outerWidth());
    var childPositionLeft = (rect.right - obj.offsetWidth / 2) - (childSize / 2);
    var childPositionTop = (rect.top + obj.offsetHeight + 10);
    $(obj).find('.menu_child_1').removeAttr('style');

    var child = $(obj).find('.menu_child_1');
    $(obj).find('.menu_child_1').css({
        'left': -((child.outerWidth() / 2) - (obj.offsetWidth / 2)) + 'px',
    });

}

function array_diff (a1, a2) {

    var a = [], diff = [];
    for (var i = 0; i < a1.length; i++) {
        a[a1[i]] = true;
    }
    for (var i = 0; i < a2.length; i++) {
        a[a2[i]]?  delete a[a2[i]]: a[a2[i]] = true;
    }
    for (var k in a) {
        diff.push(k);
    }
    return diff;
};