var table;

init();

/// <summary>
/// function that will be executed first
/// </summary>
function init()
{
    LlenarTablaCategoria();
}

function LlenarTablaCategoria()
{
    table = $('#table_categoria').DataTable({
        pageLength: 10,
        responsive: true,
        processing: true,
        ajax: "../Controller/CategoriaController.php?Operator=listar_categorias",
        columns: [
            { data : 'op'},
            { data : 'id'},
            { data : 'nombre'},
            { data : 'descripcion'},
            { data : 'estado'},
        ]
    });
}