// Call the dataTables jQuery plugin
$('document').ready(function () {

    var database = firebase.database();

    var lista_usuario = document.getElementById("users_list");

    database.ref('usuario/').limitToLast(5).on('value', res => {

        res.forEach(function (data) {
            var $tr = document.createElement('tr');
            var $td_nome = document.createElement('td');
            var $td_celular = document.createElement('td');
            var $td_endereco = document.createElement('td');

            $td_nome.innerHTML = data.val().nome;
            $td_celular.innerHTML = data.val().celular;
            $td_endereco.innerHTML = data.val().endereco + ', ' + data.val().numero + ' - ' + data.val().bairro;

            $tr.appendChild($td_nome);
            $tr.appendChild($td_celular);
            $tr.appendChild($td_endereco);

            lista_usuario.appendChild($tr);
        });

        $('#dataTable').DataTable({
            "bPaginate": false,
            "searching": false,
            "info": false
        });
    });

    // $('#dataTable').DataTable({
    // "bPaginate": false,
    // "searching": false,
    // "serverSide": true,
    // "info": false,
    // "oLanguage": {
    //     "sEmptyTable": "Nenhum registro encontrado",
    // }
    // });

    // $('#dataTable').DataTable({
    //     data: datas,
    //     "columns": [
    //         {"data": "nome"},
    //         {"data": "celular"},
    //         {"data": "endereco"}
    //     ]
    // });

});
