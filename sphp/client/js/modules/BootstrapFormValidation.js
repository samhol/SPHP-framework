(function () {
  'use strict';
  console.log('Bootstrap form validation initializing...');
  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
          .forEach(function (form) {

            console.log('found a firm that needs validation');
            form.addEventListener('submit', function (event) {
              if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
              }

              form.classList.add('was-validated');
            }, false);
          });
})();