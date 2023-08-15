$('document').ready(function() {
    $('form').on('submit', function() {
        $('button').attr('disabled', 'disabled')
        $('button').text('Memuat')
    })
})
