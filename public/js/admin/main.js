function chLanguage(obj, lan) {
    if (lan === 'undefined') return;

    $('.lan-change-btns').find('.active').removeClass('active');
    $(obj).addClass('active');
    $('.lan-fields').css('display', 'none');
    $('#lan-fields-' + lan).css('display', 'block');
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

function translit(inputId, outputId) {
    var
        rus = [' ', 'А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'],
        lat = ['-', 'A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya'];

    var string = $('#' + inputId).val().trim();
    var transLatter = '';
    var newString = '';
    for (var i = 0; i < string.length; i++) {
        transLatter = '';
        rus.forEach(function (letter, key) {
            if (letter == string[i]) {
                transLatter = lat[key];
            }
        });

        if(transLatter !== ''){
            newString += transLatter;
        }else{
            newString += string[i];
        }
    }
    $('#' + outputId).val(newString);
}