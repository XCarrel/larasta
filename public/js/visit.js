$(document).ready(function(){
    $('#edit').click(function(){
        $('#dateedit').removeClass('hidden');
        $('#houredit').removeClass('hidden');
        $('#up').removeClass('hidden');
        $('#del').removeClass('hidden');
        $('.done').removeClass('hidden');
        $('#cancel_a').removeClass('hidden');
        $('#sel').removeClass('hidden');
        $('#selm').removeClass('hidden');
        $('#vdate').addClass('hidden');
        $('#vhour').addClass('hidden');
        $('#edit').addClass('hidden');
        $('#bmail').addClass('hidden');
        $('#staid').addClass('hidden');
        $('.beval').addClass('hidden');
        $('#info').removeClass('hidden');
        $('#ok').addClass('hidden');
        $('#mok').addClass('hidden');
        $('#remove').addClass('hidden');
        $('#mremove').addClass('hidden');
    });

    $('#cancel_a').click(function(){
        $('#dateedit').addClass('hidden');
        $('#houredit').addClass('hidden');
        $('#up').addClass('hidden');
        $('#del').addClass('hidden');
        $('.done').addClass('hidden');
        $('#cancel_a').addClass('hidden');
        $('#sel').addClass('hidden');
        $('#selm').addClass('hidden');
        $('#vdate').removeClass('hidden');
        $('#vhour').removeClass('hidden');
        $('#edit').removeClass('hidden');
        $('#bmail').removeClass('hidden');
        $('.beval').removeClass('hidden');
        $('#staid').removeClass('hidden');
        $('#info').addClass('hidden');
        $('#ok').removeClass('hidden');
        $('#mok').removeClass('hidden');
        $('#remove').removeClass('hidden');
        $('#mremove').removeClass('hidden');
    });
});