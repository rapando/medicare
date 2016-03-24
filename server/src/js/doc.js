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

function prescribe(id) {
  $('.modal-prescribe').openModal();
  //fetch the name of the disease
  $.ajax({
    dataType : 'json',
    data : {req : 'viewDisease'},
    url : '../src/php/requests.php',
    type : 'post',
    success : function(res) {
      $('.disease-name').html(res);
      $("#add-dosage").on('click', function() {
        var prescription = $("#prescription").val();
        var dosage = $("#dosage").val();
        if(prescription == '' || dosage == '' )Materialize.toast("Blank fields", 2000);
        else {
          $.ajax({
            dataType : 'json',
            type : 'post',
            data : {req : 'addPrescription', patient : id, prescription : prescription, dosage : dosage},
            url : '../src/php/requests.php',
            success : function(res) {
              alert(res);
            }, error : function() {
              alert("error adding pres");
            }
          });
        }
      });
    }, error : function() {
      alert("error");
    }
  })
}

function approve(id) {
  $.ajax({
    dataType : 'approveAppointment',
    data : {req :'approveAppointment', id : id },
    type : 'post',
    url : '../src/php/requests.php',
    success : function(res) {
      alert(res);
    }
  })
}
