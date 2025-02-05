<?php

/*
    Operaciones básicas de archivos

    - copiar
    - eliminar
    - renombrar
    - mover

    Operaciones básicas carpetas
    - renombrar

*/

// Copiar
// Copiar el archivo.txt a la carpeta txt
copy('files/archivo.txt','files/txt/archivo.txt');

// Copiar el archivo archivo2.txt a la carpeta txt
copy('files/archivo2.txt','files/txt/archivo2.txt');

// Nueva versión del archivo archivo.txt
copy('files/archivo.txt','files/txt/archivo_ver_new.txt');

// Eliminar el archivo archivo.txt a la carpeta txt con otro nombre
copy('files/archivo2.txt','files/txt/archivo_new_2.txt');

// Copiar un archivo a una carpeta donde ya existe
copy('files/archivo.txt','files/txt/archivo_ver_new.txt');

// Cambiar el nombre a un archivo
rename('files/txt/archivo_ver_new.txt','files/txt/programa.txt');

// Cambiar el nombre a un archivo
rename('files/txt/archivo_new_2.txt','files/programa.txt');

// Renombrar una carpeta
rename('files/txt','files/txt_new');

// Eliminar archivo
unlink('files/programa2.txt');