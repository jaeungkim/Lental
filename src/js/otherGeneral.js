$(function() {
    $('[data-toggle="popover"]').popover()
});
$('.popover-dismiss').popover({
  trigger: 'focus'
});

// prevent html injection
$(':input:not(input[type="file"])').change(function(){
    $(this).val($(this).val().replace(/</g, "&lt;").replace(/>/g, "&gt;"));
});

// prevent first character of input being a space
$(":input").keypress(function(e){
    if(e.which === 32 && $(this).val().length==0 && !$(this).is('file')){
        return false;
    }
});

// focus on email after pressing login dropdown
function focusEmail(count){
    var timeoutCounter = count;
    if (timeoutCounter > 10){
        return;
    }
    if (!$('#emailLogin').is(":visible")){
        return setTimeout(focusEmail.bind(null, timeoutCounter + 1), 50);
    }
    $('#emailLogin').focus();
}
