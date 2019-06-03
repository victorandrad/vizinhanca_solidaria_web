// $('document').ready(function () {
//     var tabela = $('#dataTableMoradores').DataTable({
//         "bPaginate": false,
//         "searching": false,
//         "info": false
//     });
//
//     $('#pesquisa').keyup(function () {
//         tabela.draw();
//
//         $.fn.tabela.ext.search.push(
//             function (settings, data, dataIndex) {
//
//                 console.log('Teste');
//
//                 return true;
//             }
//         );
//
//     });
//
// });

/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
    function (settings, data, dataIndex) {
        var pesquisa = $('#pesquisa').val();
        var nome = data[0];

        if (pesquisa <= nome) {
            return true;
        }
        return false;
    }
);

$(document).ready(function () {
    var table = $('#dataTableOcorrencias').DataTable({
        "bPaginate": false,
        "searching": true,
        "info": false
    });

    // Event listener to the two range filtering inputs to redraw on input
    $('#pesquisa').keyup(function () {
        table.draw();
    });
});
