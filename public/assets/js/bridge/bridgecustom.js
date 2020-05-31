//popover
$(function()
{
  $("[data-toggle=popover]").popover();
});

//form validation
(function()
{
  'use strict';
  window.addEventListener('load', function()
  {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form)
    {
      form.addEventListener('submit', function(event)
      {
        if (form.checkValidity() === false)
        {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();

//text area
tinymce.init({
  selector: 'textarea'
});

//function File
$('.custom-file-input').on('change', function()
{
  let fileName = $(this).val().split('\\').pop();
  $(this).next('.custom-file-label').addClass("selected").html(fileName);
});

  //function image preview
function previewImage()
{
  document.getElementById("FilePreview").style.display = "block";
  var oFReader = new FileReader();
  oFReader.readAsDataURL(document.getElementById("FileSource").files[0]);

  oFReader.onload = function(oFREvent)
  {
    document.getElementById("FilePreview").src = oFREvent.target.result;
  };

};

//function tooltip
$(function()
{
  $('[data-toggle="tooltip"]').tooltip()
});

//current date
function CurrentDate()
{
  document.getElementById('CurrentDate').value = new Date().toISOString().substring(0, 10);
}

