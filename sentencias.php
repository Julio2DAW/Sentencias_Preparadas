<?php

require 'config.php';

class Minijuegos
{
    protected $conexion;

    function __construct(){

        $this->conexion = new mysqli(SERVIDOR, USUARIO, CONTRASENIA, BD);
    }

    function insertar(){

        $sql = "INSERT INTO minijuegos ('idMinijuego','nombre') VALUES (?,?)";

        $sentencia = $this->conexion->prepare($sql);

        $datos_insertados = [
            ['idMinijuego'=>1,'nombre'=>"Multiplos"],
            ['idMinijuego'=>2,'nombre'=>"Tabla Periódica"],
            ['idMinijuego'=>3,'nombre'=>"Reciclaje"],
            ['idMinijuego'=>4,'nombre'=>"Aprende Inglés"],
            ['idMinijuego'=>5,'nombre'=>"Liga Fútbol"]
        ];

        $sentencia->bind_param('is', $datos_insertados['idMinijuego'], $datos_insertados['nombre'] );

        $sentencia->execute();

        $sentencia->close();
    }

    function borrar(){

        $sql = "DELETE FROM minijuegos WHERE nombre=?";

        $sentencia = $this->conexion->prepare($sql);

        $datos_borrados = [
            ['idMinijuego'=>3],
            ['idMinijuego'=>4]
        ];

        $sentencia->bind_param('i', $datos_borrados['idMinijuego']);

        $sentencia->execute();

        $sentencia->close();
    }

    function modificar(){

        $sql = "UPDATE minijuegos SET nombre=? WHERE idMinijuego=?";

        $sentencia = $this->conexion->prepare($sql);

        $datos_modificados = [
            ['idMinijuego'=>4,'nombre'=>"Aprende Italiano"],
            ['idMinijuego'=>5,'nombre'=>"Liga Baloncesto"]
        ];
        
        $sentencia->bind_param('is', $datos_modificados['idMinijuego'], $datos_modificados['nombre']);

        $sentencia->execute();

        $sentencia->close();
    }
    
    function consultar(){

        $sql = "SELECT * FROM minijuegos";

        $sentencia = $this->conexion->prepare($sql);

        $sentencia->execute();

        $sentencia->bind_result($idMinijuego, $nombre);

        while ($fila = $sentencia->fetch()) {
            echo '<p>'.$idMinijuego, $nombre.'</p>';
        }

        $sentencia->close();
    }
}