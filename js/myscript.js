var bandera = false;
var status = 1;

$(".fa-bell").click(function(e){
    console.log("bell");
    $('#modal-f}notification').modal('show')
});

$(function() {
  $('.fa').click(function() {
    var wasPlay = $(this).hasClass('fa-play');

    //Status: 1 play -> 2 stop -> 3 complete stop

    console.log(status);
    var aux= $(this); //we can use it later
    $(aux).removeClass('fa-play fa-stop');
    var klass = wasPlay ? 'fa-stop' : 'fa-play';
    $(aux).addClass(klass)
    if (status==2) {
      $('#modal-alert').modal('show') //trigger the modal
      $("#btn-danger-aceptar").click(function(e){
        console.log("Click btn-danger");
        $(aux).removeClass('fa-stop fa-play');
        var klass = wasPlay ? 'fa-play' : 'fa-stop';
        $(aux).addClass(klass)
        /*
        ... code to stop process

        */
      });
    }

    status++;
    if (status==3) {
      status = 1
    }
  });
});
