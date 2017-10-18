function chLanguage(obj,lan){
    if(lan === 'undefined') return;

    $('.lan-change-btns').find('.active').removeClass('active');
    $(obj).addClass('active');
    $('.lan-fields').css('display', 'none');
    $('#lan-fields-'+lan).css('display', 'block');
}

function categoriesCollapse() {
    $('.collapse-btn').click(function () {
        $(this).find('.collapse-arrow').toggleClass('collapse-arrow-rotated');
        $(this).parent().parent().find('ul:first').slideToggle();
    });
}

function showNotification(text, type) {

    var nt = $('#notifications_holder').append('<div class="nt_' + type + '">' + text + '</div>').find('div:last-child');

    if ($('#notifications_holder div').length > 4) {
        $('#notifications_holder div:first-child').remove();
    }
    window.setTimeout(function () {
        $(nt).fadeOut(function () {
            nt.remove();
        })
    }, 5000)
}