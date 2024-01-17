function ValidarUsuario()
{
    correo = $("#user_correo").val();
    clave = $("#user_clave").val();
    parametros = 
    {
        "correo":correo,"clave":clave
    }
    $.ajax({
        data:parametros,
        type:'POST',
        url:'Controller/UsuarioController.php?Operator=validar_usuario',
        beforeSend:function(){},
        success:function(response){
            if(response == "success")
            {
                location.href="pages/welcome.php";
            }
            else if(response == "not found")
            {
                msg = '<div class="alert alert-danger mb-2" role="alert"><strong>Oh no!</strong>' +
                'Las credenciales no son correctas';
            }
            else if(response == "requiere id")
            {
                msg = '<div class="alert alert-danger mb-2" role="alert"><strong>Oh no!</strong>' +
                'Parece q no has completado los campos';
            }
            console.log(response);
            $('#status_login').html(msg);
            LimpiarCampos();
        }
    });
}

function LimpiarCampos()
{
    $('#user_correo').val("");
    $('#user_clave').val("");
}