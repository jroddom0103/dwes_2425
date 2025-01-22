<?php

/**
 * Conversiones de tipos
 */

 $var = 3;

 var_dump(value: $var);

 // Conversión mediante funciones

// strval
 $var1 = strval(value: $var);
 echo "<BR>";
 var dump(value: $var1);

 //intval
 $var2 = intval(value: $var1);
 echo "<BR>";
 var dump(value: $var2);

 //floatval
 $var3 = floatval(value: $var);
 echo "<BR>";
 var dump(value: $var3);

 # Conversión (tipo dato)  variable
$var4 = 7.89;
$var4 = (int) $var4;
echo "<BR>";
var_dump(vale: $var4);

$var5 = 89;
$var5 = (float) $var5;
echo "<BR>";
var_dump(value: $var5);

$var6 = 89;
$var6 = (string) $var6;
echo "<BR>";
var_dump(value: $var6);

$var7 = 100;
$var7 = (array) $var7;
echo "<BR>";
var_dump(value: $var7);

// Conversión mediante settype
$var8 = 45;
settype(var:  &$var8, type: "string");
echo "<BR>";
var_dump(value: $var8); 
