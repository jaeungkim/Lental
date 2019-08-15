// for going to next card in accordion when using tab to move between inputs
$('.tabFocus').bind('focus', function() {
    $(this).trigger('click');
});

// show error message if any empty fields on submit
$("#proceedBtn").on("click", function() {
    var hasEmpty = false;
    var first = "";
    $("[required]").each(function() {
        if (($(this).val().length == 0 && $(this).attr('id') != "pCode") || ($(this).attr('id') == "pCode" && $(this).val().length != 6)) {
            hasEmpty = true;
            // add class bg-warning to inputs not filled to required
            obj = $(this).siblings(".input-group-prepend").children("span");
            obj.addClass('bg-warning');
            if (first == ""){
                first = obj;
            }
        }
    });
    // show error message if empty input field and show first required input
    if (hasEmpty) {
        $("#addListingError").removeClass("d-none");

        // check if input is visible, if not, show input
        if (!first.is(":visible")){
            first.closest('.collapse').siblings('a').focus();
        }
    }
});

// remove bg-warning class on focus
$("[required]").on("focus change", function() {
    var obj = $(this).siblings(".input-group-prepend").children("span");
    if (($(this).val().length != 0 && $(this).attr('id') != "pCode") || ($(this).attr('id') == "pCode" && $(this).val().length == 6)){
        obj.removeClass('bg-warning');
        // alert($(this).attr('id'));
    }

    // remove error message if input focused
    $("#addListingError").addClass("d-none");
});

// make sure uploaded files aren't too large
$('#inputGroupFile').bind('change', function() {
  //this.files[0].size gets the size of your file.
  var isOk = true;
  for (var i = 0; i<this.files.length; i++){
      if (this.files[i].size <= 0 || this.files[i].size > 1000000){
          // console.log(this.files[i].size);
          isOk = false;
      }
  }
  // if file size is not good, empty input field and show error msg
  if (!isOk){
      document.getElementById('inputGroupFile').value= null;
      $(this).next('.custom-file-label').html('Choose images');
      // show error msg
      $("#imageInputError").removeClass("d-none");
  } else {
      // update image input filenames
      var files = [];
      for (var i = 0; i < $(this)[0].files.length; i++) {
          files.push($(this)[0].files[i].name);
      }
      $(this).next('.custom-file-label').html(files.join(', '));

      // remove error msg if present
      if (!$("#imageInputError").hasClass("d-none")){
          $("#imageInputError").addClass("d-none");
      }
  }
});

// check postal code correctness
$("#pCode").keypress(function(e){
    if(e.which === 32){
        return false;
    }
});

$("#pCode").keyup(function(){
    var pCode = $('#pCode');
    if (pCode.val().length > 0 && pCode.val().length!=6){
        // show error msg
        $("#pCodeError").removeClass("d-none");
    } else {
        // remove error msg
        if (!$("#pCodeError").hasClass("d-none")){
            $("#pCodeError").addClass("d-none");
        }
    }
});

$("#pCode").change(function(){
    var pCode = $('#pCode');
    pCode.val(pCode.val().replace(' ',''));
});
