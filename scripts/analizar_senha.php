
<?php 

function analisarSenha($senha){ 


$letrasMaiusculas = letrasMaiusculas($senha);
$letrasMinusculas = letrasMinusculas($senha);
$quantidadeNumeros = quantidadeNumeros($senha);
$caracteresEspeciais = caracteresEspeciais($senha);
$tamanho = tamanho($senha);

//calculo de seguranca
$forca = 0;

if($letrasMaiusculas>=1){$forca += 2;}
if($letrasMinusculas>=4){$forca += 2;}
if($quantidadeNumeros>=3){$forca += 2;}
if($caracteresEspeciais>=1){$forca += 2;}
if($tamanho>=8){$forca += 2;}


if($forca >= 6){
    $seguranca = true;
}else{
    echo '<script>alert("Senha inválida.");</script>';
    echo '<script>window.location.href = "../usuarios/cadastro_usuarios.php";</script>';
}

return[
   $seguranca
];

}



//função que ira ver quantas letras maiusculas tem na senha
function letrasMaiusculas($a){

preg_match_all('/\p{Lu}/u', $a, $matches);
$letrasMaiusculas = count($matches[0]);

  return $letrasMaiusculas;
}




//função que ira ver quantas letras minusculas tem na senha
function letrasMinusculas($b){

preg_match_all('/\p{Ll}/u', $b, $matches);
$letrasMinusculas = count($matches[0]);

    return $letrasMinusculas;
}

//função que ira a ver a quantidade de números da senha
function quantidadeNumeros($c){

preg_match_all('/\d/', $c, $matches);
$quantidadeNumeros = count($matches[0]);

    return $quantidadeNumeros;

}

//função que ira ver a quantidade de caracteres especiais da senha
function caracteresEspeciais($d){

preg_match_all('/[^a-zA-Z0-9\s]/u', $d, $matches);
$caracteresEspeciais = count($matches[0]);

    return $caracteresEspeciais;
}

//função que ira ver o tamanho da senha
function tamanho($e){

$semEspaco = preg_replace('/\s+/', "", $e);
$tamanho = mb_strlen($semEspaco);

    return $tamanho;
}

?>