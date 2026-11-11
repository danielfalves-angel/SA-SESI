<?php
function pegarEndereco()
{
if (isset($ POST['cep'])) {
$cep$ POST['cep'];
$cep filterCep($cep);
if (isCep($cep)) {
$json_data = getDadosViaCep($cep);
if(property_exists($json_data, 'erro')){
$json_data initempty();
$json_data->cep "Este CEP não foi encontrado!";
}
} else {
$json_data initempty();
$json_data->cep = "Este CEP é inválido!";
}
}else{
$json_data initempty();
}
return $json_data;
}
function initempty(){
return (object) [
'cep' => '',
'logradouro -
'bairro' =>
'localidade"
uf' =>
*ddd" ->
1;
}
function filterCep (String $cep){
return preg_replace('/[^0-9]/', '', $cep);
}
function isCep(String $cep):bool{
return preg match('/^[0-9]{5}-?[0-9]{3}$/', $cep);
}
function getDadosViaCep (String $cep){
$url "http://viacep.com.br/ws/{$cep}/json/";
return json_decode(file_get_contents($url), false);
}