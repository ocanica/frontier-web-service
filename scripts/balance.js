$(document).ready(function() {

  $('#deposit-form').on('submit', function(event) {
    var d_value = $('#deposit-form').serialize()
    event.preventDefault()
    $('#deposit-form').attr('disabled', true)
    $.ajax({
      type: 'POST',
      url: 'balance.php',
      data: d_value,
      success: function () {
        $("#balance").load('balance.php'),
        $('#deposit-form')[0].reset(),
        $('#deposit-form').removeAttr('disabled')
      }
    })
  }),

  $('#withdrawl-form').on('submit', function(event) {
    var w_value = $('#withdrawl-form').serialize()
    event.preventDefault()
    $('#withdrawl-form').attr('disabled', true)
    $.ajax({
      type: 'POST',
      url: 'balance.php',
      data: w_value,
      success: function () {
        $("#balance").load('balance.php'),
        $('#withdrawl-form')[0].reset(),
        $('#withdrawl-form').removeAttr('disabled')
      },
      error: function(jqxhr, status, response) {
        $("#balance").html('<p>An error has occured: ' + jqxhr.status + ' - ' + jqxhr.statusText + '</p>');
      }
    })
  })

});



