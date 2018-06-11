$(document).ready(function() {
    $('#quotes-mod').onsubmit(function(event) {
        event.preventDefault()
        $('#quotes-mod').attr('disabled', true)

        var amount = $('#amount').val();
        var curr_select = $('#curr-select').val();
        var src_uid = $('#src-uid-select').val();
        var dest_uid = $('#dest-uid-select').val();

        $ajax({
            url: 'transaction.php',
            method: 'post',
            data: {
                transaction: 1,
                q: query
            }
        })
    })
})