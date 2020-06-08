  <?php
//Se recibe los valores, no se validan que esten vascíos puesto que en el html se valida con las regex
$n=$_POST['name'];
$p=$_POST['lnf'];
$m=$_POST['lnm'];
$d=$_POST['dt'];
$rfc=$_POST['rfc'];
$password=$_POST['password'];
//Se le quitan los acentos a los cadenas que se reciben con los formularios, de apellido paterno, apellido materno y nombre
$n=str_replace("á","a",$n);
$n=str_replace("é","e",$n);
$n=str_replace("í","i",$n);
$n=str_replace("ó","o",$n);
$n=str_replace("ú","u",$n);

$p=str_replace("á","a",$p);
$p=str_replace("é","e",$p);
$p=str_replace("í","i",$p);
$p=str_replace("ó","o",$p);
$p=str_replace("ú","u",$p);

$m=str_replace("á","a",$m);
$m=str_replace("é","e",$m);
$m=str_replace("í","i",$m);
$m=str_replace("ó","o",$m);
$m=str_replace("ú","u",$m);

//De acuerdo con el SAT una de las excepciones más recurrentes, por lo que decidí incliuirla es la ñ, de ese modo se extrae la primera letra del apellido y se substituye por una x
$flf=substr($p,0, 2);
$flm=substr($m,0, 2);
if($flf=="Ñ"){
  $p=str_replace("Ñ","X",$p);
 }
 if($flm=="Ñ"){
   $m=str_replace("Ñ","X",$m);
  }
//Se transforman las cadenas a mayúsculas y minúsculas(para usarse más adelante)
$N=strtoupper($n);
$P=strtoupper($p);
$M=strtoupper($m);
$nn=strtolower($n);
$npp=strtolower($p);
$nm=strtolower($m);

//Para crear la RFC, se extraen los valores correspondientes de los apellidos y nombre
//Primera letra del nombre
$subN= substr($N,0, 1);
//Primeras dos letras del apellido paterno
$subP= substr($P,0, 2);
//Primera letra del apellido materno
$subM= substr($M,0, 1);
//Ultimos dos dígitos de la fecha de Nacimiento
$subda= substr($d,2, 2);
//Digitos del mes
$subdm= substr($d,5, 2 );
//Digitos del día
$subdd= substr($d,8, 8);
//De la RFC inresada en el formulario se extraen los dígitos hasta antes de la Homoclave
$sub=substr($rfc,0, 10);
//Se concatenan las cadenas y se almacenan en una variable
$RFC=$subP. $subM. $subN. $subda. $subdm. $subdd."";
//Solo se verifica la RFC puesto que los nombres se verificaro con regex, así como los apellidos y en base a ello se crea la RFC hasta antes de la Homoclve

if ($sub != $RFC)
 {
  echo "Dato inválido: Verfique su RFC hasta antes de la Homoclave, escribió $sub cuando debería ser $RFC";
}else{
  echo "Sus datos son correctos";
}
echo "<br>";
//Arreglo de Contraseñas
$insecurepasswords=[
  0 =>'',
  1 =>'password',
  2 =>'123456789',
  3 =>'12345678',
  4 =>'12345',
  5 =>'111111',
  6 =>'1234567',
  7 =>'sunshine',
  8 =>'qwerty',
  9 =>'iloveyou',
  10 =>'princess',
  11 =>'admin',
  12 =>'welcome',
  13 =>'666666',
  14 =>'abc123',
  15 =>'contraseña',
  16 =>'123456'
];
//Se almacena el nombre completo en mayúsculas como en minúsculas
$nombre= $n. $p. $m."";
$NOMBRE= $N. $P. $M."";
//Se busca que la contraseña ingresada no se encuentre en el arreglo de las contraseñas con array_search que devuelve un valor boleano
$passwordlooker=array_search( $password ,$insecurepasswords);
//Se compara que la contraseña ingresada no sea igual a los datos ingresados por el usuario, así como alguna de las contraseñas inseguras
if ($passwordlooker==true | $password=="$n"|$password=="$p"|$password=="$m"|$password=="$nn"|$password=="$npp"|$password=="$nm"|$password=="$N"|$password=="$P"|$password=="$M"|$password=="$nombre"|$password=="$NOMBRE"|$password=="$rfc"|$password=="$RFC")
 {
   echo "Su contraseña: '$password' es insegura";
 }else{
  echo"Su contraseña es Segura"; 
 }

?>
