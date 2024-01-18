<?php

require "../Models/Categoria.php";

$categoria = new Categoria();

switch ($_REQUEST["Operator"])
{
    case "listar_categorias":
        $datos = $categoria->ListarCategorias();
        if($datos)
        {
            for($i = 0; $i < count($datos); $i++)
            {
                $list[] = array (
                    "op"=>'<div class="btn-group">
                    <button class="btn btn-info dropdown-toggle btn-sm" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                    <i class="icon-gear"></i>
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" data-toggle="modal" data-target="#update_categoria" onclick="ObtenerCategoriaPorID('.$datos[$i]['categoria_id'].');"><i class="icon-edit"></i> Editar</a>
                    <a class="dropdown-item"><i class="icon-trash"></i> Eliminar</a>
                    </div>
                    </div>',
                    "id"=>$datos[$i]['categoria_id'],
                    "nombre"=>$datos[$i]['nombre'],
                    "descripcion"=>$datos[$i]['descripcion'],
                    "estado"=>($datos[$i]['estado'] == 1)?'<div class="tag tag-success">Activo</div>':
                                                        '<div class="tag tag-danger">Inactivo</div>'
                );
            }
            $resultados = array(
                "sEcho" => 1,
                "iTotalRecords" => count($list),
                "iTotalDisplayRecords" => count($list),
                "aaData" => $list
            );
        }
        echo json_encode($resultados);
    break;

    case "registrar_categoria":
        if(isset($_POST["nombre"], $_POST["descripcion"])
         && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]))
        {
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            if($categoria->RegistrarCategoria($nombre, $descripcion))
            {
                $response = "success";
            }
            else
            {
                $response = "requiere id";
            }
        }
        echo $response;
    break;

    case "obtener_categoria_por_id":
        if (isset($_POST["categoria_id"]) && !empty($_POST["categoria_id"]))
        {
            $data = $categoria->ObtenerCategoriaPorID($_POST["categoria_id"]);
            if($data)
            {
                $list[] = array(
                    "id"=>$data['categoria_id'],
                    "nombre"=>$data['nombre'],
                    "descripcion"=>$data['descripcion']
                );
                echo json_encode($list);
            }
        }

    break;

    case "actualizar_categoria":
        if(isset($_POST["nombre"], $_POST["descripcion"], $_POST["categoria_id"])
         && !empty($_POST["nombre"]) && !empty($_POST["descripcion"]) && !empty($_POST["categoria_id"]))
        {
            $categoria_id = $_POST["categoria_id"];
            $nombre = $_POST["nombre"];
            $descripcion = $_POST["descripcion"];
            if($categoria->ActualizarCategoria($categoria_id, $nombre, $descripcion))
            {
                $response = "success";
            }
            else
            {
                $response = "requiere id";
            }
        }
        echo $response;

    break;
}


?>