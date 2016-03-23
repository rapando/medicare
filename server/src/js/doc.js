jQuery(document).ready(function($) {
  $("a[href='#my-patients']").on('click', function(e) {
    e.preventDefault();
    Materialize.showStaggeredList("#my-patients-table");

  });

  $("a[href='#my-appointments']").on('click', function(e) {
    e.preventDefault();
    Materialize.showStaggeredList("#my-appointments-table");
  })

  $("a[href='#my-prescriptions']").on('click', function(e) {
    e.preventDefault();
    Materialize.showStaggeredList("#my-prescriptions-table");
  })


});
