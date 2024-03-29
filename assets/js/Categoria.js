var table;

init();

/// <summary>
/// function that will be executed first
/// </summary>
function init()
{
    LlenarTablaCategoria();
}

/// <summary>
/// function that will load the table with data
/// </summary>
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

/// <summary>
/// function to register a new Categoria
/// </summary>
function RegistrarCategoria()
{
    nombre = $('#nombre_cat').val();
    descripcion = $('#descripcion_cat').val();
    parametros = {
        "nombre":nombre,"descripcion":descripcion
    }
    $.ajax({
        data:parametros,
        url:'../Controller/CategoriaController.php?Operator=registrar_categoria',
        type:'POST',
        beforeSend:function(){},
        success:function(response)
        {
            if(response == "success")
            {
                table.ajax.reload();
                LimpiarControles();
                $('#create_categoria').modal('hide');
                toastr.success("Se guardo correctamente", "Registro exitoso");
            }
            else if(response == "requiere id")
            {
                toastr.error("Complete todos los campos", "Campos Incompletos!");
            }
            else
            {
                toastr.error("Ocurrio algo inesperado", "Error de sistema");
            }
            console.log(response);
        }
    })
}

/// <summary>
/// function to register a new Categoria
/// </summary>
function ActualizarCategoria()
{
    categoria_id = $('#codigo_cat_edit').val();
    nombre = $('#nombre_cat_edit').val();
    descripcion = $('#descripcion_cat_edit').val();
    parametros = {
        "categoria_id":categoria_id, "nombre":nombre, "descripcion":descripcion
    }
    $.ajax({
        data: parametros,
        url: '../Controller/CategoriaController.php?Operator=actualizar_categoria',
        type:'POST',
        beforeSend:function(){},
        success:function(response){
            if(response == "success")
            {
                table.ajax.reload();
                $('#update_categoria').modal('hide');
                toastr.success("Se guardo correctamente", "Actualizacion exitosa");
            }
            else if (response == "requiere id"){
                toastr.error("Complete todos los campos por favor", "Campos Incompletos");
            }
            else{
                toastr.error("Ocurrio algo inesperado", "Error de sistema");
            }
            console.log(response);
        }
    });
}

/// <summary>
/// Clean inputs
/// </summary>
function LimpiarControles()
{
    $('#nombre_cat').val('');
    $('#descripcion_cat').val('');
}

/// <summary>
/// eliminate categoria
/// </summary>
function EliminarCategoria(categoria_id)
{
    $.ajax({
        data: {"categoria_id":categoria_id},
        url: '../Controller/CategoriaController.php?Operator=eliminar_categoria',
        type: 'POST',
        beforeSend:function(){},
        success:function(response)
        {
            if(response == "success")
            {
                table.ajax.reload();
                Swal.fire({
                    title: "Eliminado",
                    text: "La categoria fue elimina exitosamente",
                    icon: "success"
                });
            }
            else
            {
                toastr.error("error de sistema","Error");
            }
        }
    })
}

/// <summary>
/// activate categoria
/// </summary>
function ActivarCategoria(categoria_id)
{
    $.ajax({
        data: {"categoria_id":categoria_id},
        url: '../Controller/CategoriaController.php?Operator=activar_categoria',
        type: 'POST',
        beforeSend:function(){},
        success:function(response)
        {
            if(response == "success")
            {
                table.ajax.reload();
                Swal.fire({
                    title: "Activada",
                    text: "La categoria fue activada exitosamente",
                    icon: "success"
                });
            }
            else
            {
                toastr.error("error de sistema","Error");
            }
        }
    })
}

/// <summary>
/// get Categoria by ID
/// </summary>
function ObtenerCategoriaPorID(categoria_id, op)
{
    $.ajax({
        data: { "categoria_id": categoria_id },
        url: '../Controller/CategoriaController.php?Operator=obtener_categoria_por_id',
        type:'POST',
        beforeSend:function(){},
        success:function(response)
        {
            data = $.parseJSON(response);
            if(data.length > 0)
            {
                if(op=="editar")
                {
                    $('#codigo_cat_edit').val(data[0]["id"]);
                    $('#nombre_cat_edit').val(data[0]['nombre']);
                    $('#descripcion_cat_edit').val(data[0]['descripcion']);
                }
                else if (op=="eliminar")
                {
                    AlertEliminar(data[0]["id"]);
                }
                else if (op="activar")
                {
                    AlertActivate(data[0]["id"]);
                }
                
            }
            console.log(response);
        }
    });
}

function AlertEliminar(categoria_id)
{
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.value) 
        {
          // eliminate categoria
          EliminarCategoria(categoria_id);
        }
      });
}

function AlertActivate(categoria_id)
{
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "info",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.value) 
        {
          // eliminate categoria
          ActivarCategoria(categoria_id);
        }
      });
}