<?php

class crud extends conexion
{
    public function mostrarDatos()
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $datos = $coleccion->find();
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function mostrarDatosMiscelaneos()
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->miscelaneos;
            $datos = $coleccion->find();
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function mostrarDatosEliminados()
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->eliminados;
            $datos = $coleccion->find();
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function mostrarDatosMaquinariaVista()
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $datos = $coleccion->find();
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function mostrarDatosMaquinaria($estatus)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $datos = $coleccion->find(['estatus' => $estatus]);
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function obtenerDocumento($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $datos = $coleccion->findOne(
                array(
                    '_id' => new MongoDB\BSON\ObjectId($id)
                )
            );
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function obtenerDocumentoMiscelaneo($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->miscelaneos;
            $datos = $coleccion->findOne(
                array(
                    '_id' => new MongoDB\BSON\ObjectId($id)
                )
            );
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function obtenerDocumentoMaquinaria($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $datos = $coleccion->findOne(
                array(
                    '_id' => new MongoDB\BSON\ObjectId($id)
                )
            );
            return $datos;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function insertarDatos($datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $respuesta = $coleccion->insertOne($datos);
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function insertarDatosEliminados($datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->eliminados;
            $respuesta = $coleccion->insertOne($datos);
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function insertarDatosMiscelaneos($datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->miscelaneos;
            $respuesta = $coleccion->insertOne($datos);
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function insertarDatosMaquinaria($datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $respuesta = $coleccion->insertOne($datos);
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function eliminar($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $respuesta = $coleccion->deleteOne(
                array(
                    "_id" => new MongoDB\BSON\ObjectId($id)

                )
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function eliminarMiscelaneo($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->miscelaneos;
            $respuesta = $coleccion->deleteOne(
                array(
                    "_id" => new MongoDB\BSON\ObjectId($id)

                )
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function eliminarMaquinaria($id)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $respuesta = $coleccion->deleteOne(
                array(
                    "_id" => new MongoDB\BSON\ObjectId($id)

                )
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function actualizar($id, $datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $respuesta = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($id)],
                [
                    '$set' => $datos
                ]
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function actualizarMiscelaneos($id, $datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->miscelaneos;
            $respuesta = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($id)],
                [
                    '$set' => $datos
                ]
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function actualizarMaquinaria($id, $datos)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $respuesta = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($id)],
                [
                    '$set' => $datos
                ]
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function agregarMantenimiento($id, $mantenimiento)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->maquinaria;
            $respuesta = $coleccion->updateOne(
                ["_id" => new MongoDB\BSON\ObjectId($id)],
                ['$push' => ['mantenimientos' => $mantenimiento]]
            );
            return $respuesta;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function mensajesCrud($mensaje)
    {
        $msg = '';
        if ($mensaje == 'insert') {
            $msg = 'swal("Excelente","Agregado con exito","success")';
        } elseif ($mensaje == 'update') {
            $msg = 'swal("Excelente","Actualizado con exito","info")';
        } elseif ($mensaje == 'delete') {
            $msg = 'swal("Excelente","Eliminado con exito","warning")';
        } elseif ($mensaje == 'invalido') {
            $msg = 'swal("Error","Correo o Contraseña Invalida","warning")';
        } elseif ($mensaje == 'notificacion') {
            $msg = 'swal("Precaucion","Verifica el gestor de notificaciones","warning")';
        } elseif ($mensaje == 'exist') {
            $msg = 'swal("Precaucion","El usuario existe, pruebe otro correo","warning")';
        }
        return $msg;
    }
    public function autenticarUsuario($correo, $password)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $usuario = $coleccion->findOne(["correo" => $correo]);
            if ($usuario && password_verify($password, $usuario["password"])) {
                return ['autenticado' => true, 'nivel' => $usuario["nivel"]];
            } else {
                // Las credenciales son incorrectas
                return ['autenticado' => false];
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
    public function verificarUsuario($correo)
    {
        try {
            $conexion = conexion::conectar();
            $coleccion = $conexion->user;
            $usuario = $coleccion->findOne(["correo" => $correo]);
            if ($usuario == null) {
                return true;
            } else {
                // Las credenciales son incorrectas
                return false;
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
