<?php

function mask($valb, $mask){
  $vala = '';
  $w = 9;
  for($w=9; $w>=0; $w--){
    if($valb[$w] != "-")
      $vala .= $valb[$w];
  }

  $valc = '';
  $x = 7;
  for ($x; $x>=0; $x--){
    $valc .= $vala[$x];
  }

  $ano = $valc[0].''.$valc[1].''.$valc[2].''.$valc[3];
  $mes = $valc[4].$valc[5];
  $dia = $valc[6].$valc[7];
  $val = $dia.$mes.$ano;

  $maskared = '';
  $k = 0;
  for($i = 0; $i<=strlen($mask)-1; $i++)
  {
    if($mask[$i] == '#')
    {
        if(isset($val[$k]))
        $maskared .= $val[$k++];
    }
    else
  {
      if(isset($mask[$i]))
      $maskared .= $mask[$i];
      }
  }
  return $maskared;
}

?>