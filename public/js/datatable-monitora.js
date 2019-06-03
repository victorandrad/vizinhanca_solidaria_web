$('document').ready(async function () {

    var database = firebase.database();

    var lista_notificacao = document.getElementById("lista_ocorrencias");

    await database.ref('notificacao').limitToLast(5).on('value', res => {
        lista_notificacao.innerHTML = "";
        res.forEach(function (data) {
            if (!data.val().atendimento) {
                var $tr = document.createElement('tr');
                var $td_remetente = document.createElement('td');
                var $td_data_hora = document.createElement('td');
                var $td_acao = document.createElement('td');

                $td_remetente.innerHTML = data.val().remetente;
                $td_data_hora.innerHTML = data.val().data_hora;
                $td_acao.innerHTML = '<form method="POST"\n' +
                    'action="/detalhe-monitora">\n' +
                    '<input type="hidden" value="' + $('meta[name="csrf-token"]').attr('content') + '" name="_token">' +
                    '<input type="hidden" class="form-control"\n' +
                    'value="' + data.key + '"\n' +
                    'id="key-ocorrencia" name="key-ocorrencia">\n' +
                    '<button type="submit" class="btn btn-primary btn-circle btn-sm">\n' +
                    '<i class="fas fa-eye"></i>\n' +
                    '</button>\n' +
                    '</form>';

                $tr.appendChild($td_remetente);
                $tr.appendChild($td_data_hora);
                $tr.appendChild($td_acao);

                lista_notificacao.appendChild($tr);
            }
        });
    });
});
