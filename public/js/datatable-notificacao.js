$('document').ready(async function () {
    //
    // var database = firebase.database();
    //
    // var lista_notificacao = document.getElementById("notificacao_list");
    //
    // await database.ref('notificacao/').limitToLast(5).on('value', res => {
    //     lista_notificacao.innerHTML = "";
    //     res.forEach(function (data) {
    //         var $tr = document.createElement('tr');
    //         var $td_nome = document.createElement('td');
    //         var $td_celular = document.createElement('td');
    //         var $td_endereco = document.createElement('td');
    //
    //         var datas = data.val().data_hora.split(' ')[0];
    //         var dia = datas.split('/')[0];
    //         var mes = datas.split('/')[1];
    //         var ano = datas.split('/')[2];
    //
    //         $td_nome.innerHTML = data.val().remetente;
    //         $td_celular.innerHTML = moment(ano + '-' + mes + '-' + dia).format('DD/MM/YYYY');
    //         $td_endereco.innerHTML = !data.val().atendimento ? 'Não' : 'Sim';
    //
    //         $tr.appendChild($td_nome);
    //         $tr.appendChild($td_celular);
    //         $tr.appendChild($td_endereco);
    //
    //         lista_notificacao.appendChild($tr);
    //     });
    // });

    $('#dataTable1').DataTable({
        "bPaginate": false,
        "searching": false,
        "info": false
    });
});
