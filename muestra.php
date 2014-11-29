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

$lee_dir = opendir($ruta_mini);
$archivos = [];
while($archivo = readdir($lee_dir)){
    if(!is_dir($archivo)){
        array_push($archivos, $archivo);
    }
}
closedir($lee_dir);

krsort($archivos);

foreach ($archivos as $archivo) {
    echo "<div class=\"mini\">";
    echo "<img src='".$ruta_mini.$archivo."' nombre='$archivo'>";
    echo "<a href='procesa.php?nombre=".$archivo."' title='borrar'></a>";
    echo "</div>";
}
