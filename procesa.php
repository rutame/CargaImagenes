<?php

/* 
 * Copyright (C) 2014 Pedro Gabriel Manrique Gutiérrez <pedrogmanrique at gmail.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
// Ruta
include 'config.php';
function miniatura($ruta, $name, $ruta_mini, $ext){
    switch ($ext){
        case ".jpg":
        $original = imagecreatefromjpeg($ruta.$name); 
        break;
        case ".png":
        $original = imagecreatefrompng($ruta.$name); 
        break;
        case ".gif":
        $original = imagecreatefromgif($ruta.$name); 
        break;
    }
    
    $ancho = imagesx($original);
    $alto = imagesy($original);
    // Miniatura
    $tamx = 150;
    $tamy = 150;
    
    $miniatura = imagecreatetruecolor($tamy, $tamx);
    imagecopyresampled( $miniatura, 
                        $original,
                        0,0,0,0,
                        $tamx,$tamy,
                        $ancho,$alto);
    imagejpeg($miniatura, $ruta_mini.$name);
}
if($_FILES){
    $temp = $_FILES['archivo']['tmp_name'];
    $name = uniqid();
    $size = $_FILES['archivo']['size'];
    $tipo = $_FILES['archivo']['type'];
    $valida = 1;
    
    switch ($tipo) {
        case "image/jpeg":
            $ext = ".jpg";
            break;
        case "image/png":
            $ext = ".png";
            break;
        case "image/gif":
            $ext = ".gif";
            break;
        default:
            $valida = 0;
            break;
    }
    if($valida && size <= $peso){
        $name = $name.$ext;
        if(move_uploaded_file($temp, $ruta.$name)){
            miniatura($ruta, $name, $ruta_mini, $ext);
            
        }
        header("location: index.php");
    }
    else{
        echo "Archivo o Imagen no permitida";
    }
}
if($_GET['nombre']){
    
    unlink($ruta_mini.$_GET['nombre']);
    unlink($ruta.$_GET['nombre']);
    header("location:index.php");
}

