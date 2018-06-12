$(document).ready(function() {
  
  $(function() {
    var curr = 'Australian Dollar';
    var src;
    var amount = 100;

    $(document).on('click', '#response li', function() {
      curr = $(this).text();
      var curr_name = $(this).text();
      src = $("#src-uid-select option:selected").attr("value");
      $('#curr-select').val(curr_name);
      $('#response').html("");
    });

    $(document).on('click', function() {
      src = $("#src-uid-select option:selected").attr("value");
    });

    $(document).on('keyup', function() {
      amount = $('#amount').val();
    });
    $(document).on('click keyup ready', function(event) {
      
      if (event.type == "click" || event.type == "keyup" || event.type == "ready") {
        $.ajax({
          url: 'quote.php',
          method: 'post',
          data: {
            quote: 1,
            amount_q: amount,
            curr_q: curr,
            src_q: src
          },
          success: function(data) {
            var fees = '';
            var final = '';
            var curr_code = '';
            
              $.each(data, function(index, item) {
                fees = item.fees;
                final = item.final_less_fees;
                curr_code = item.curr_code;
              });
              $('#quote-fees').html(fees);
              $('#quote-amount').html(final);
              $('#quote-curr-code').html(curr_code);
            
          },
          dataType: 'json'
        })
      }      
  
    });
  });


  $('#curr-select').keyup(function() {
    var query = $('#curr-select').val();
    if(query.length > 2) {
      $.ajax({
        url: 'curr_call.php',
        method: 'post',
        data: {
          search: 1,
          q: query
        },
        success: function(data) {
            $('#response').html(data);
        },
        dataType: 'text'
      })
    }
  });

  $(function() {
    var src = "";
    $.getJSON("src_call.php", function(data) {
      $.each(data, function(index, item) {
        src += "<option value='"+item.acc_uid+"'>"+item.acc_uid+"</option>";
      });
      $("#src-uid-select").html(src);
    });
  });

  $(function() {
    var dest = "";
    $.getJSON("dest_call.php", function(data) {
      $.each(data, function(index, item) {
        dest += "<option value='"+item.acc_uid+"'>"+item.acc_uid+"</option>";
      });
      $("#dest-uid-select").html(dest);
    });
    
  });

  $('#quotes-mod').on('submit',function(event) {
    event.preventDefault()
    $('#quotes-mod').attr('disabled', true)

    var amount = $('#amount').val();
    var curr = $('#curr-select').val();
    var src = $('#src-uid-select').val();
    var dest = $('#dest-uid-select').val();

    $.ajax({
        url: 'balance.php',
        method: 'post',
        data: {
          quote: 1,
          amount_q: amount,
          curr_q: curr,
          src_q: src,
          dest_q: dest
        },
        success: function () {
          $("#balance").load('balance.php')
        }
    })
  })
  
});