$(function () {
    $('#submit').click(function (e) {
        $('#spinner').toggle();
        $('#cadastrals').empty();
        
        var data = {
            coords: $('#cadastral').val(),
            _token: $('#token').val()
        };
        
        $.ajax({
            url: $('#main-form').data('url'),
            data: data,
        })
            .done(function (res) {
                if (res.cadastrals.length) {
                    let table = '<div style="margin-top: 10px;">всего ' + res.cadastrals.length + ' записи</div>' +
                        '<table class="table table-striped table-bordered"><thead><tr>' +
                        '<th scope="col">Кадастровый номер</th><th scope="col">Адрес</th>' +
                        '<th scope="col">Стоимость</th><th scope="col">Площадь</th></tr></thead><tbody>';
                    for (const cad of res.cadastrals) {
                        table += '<tr>' +
                            '<td>' + cad.cadastral_number + '</td>' +
                            '<td>' + cad.address + '</td>' +
                            '<td>' + cad.price + '</td>' +
                            '<td>' + cad.area + '</td>' +
                            '</tr>';
                    }       
                    table += '</tbody></table>';
                    $('#cadastrals').append(table);
                } else {
                    $('#cadastrals').text('Кадастровых записей не найдено.');
                }             
            })
            .fail(function (res) {
                let errorDiv = '<div class="alert alert-danger" role="alert">';
                if (res.responseJSON.errors.coords) {
                    for (const error of res.responseJSON.errors.coords) errorDiv += error + ' ';
                } else {
                    errorDiv += 'Возникла ошибка, попробуйте повторить операцию позже.';
                }
                errorDiv += '</div>';
                $('#cadastrals').append(errorDiv);
            })
            .always(function() {
                $('#spinner').toggle();
            });
            
     });
});