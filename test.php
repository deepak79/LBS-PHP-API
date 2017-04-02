<?php
$fav = "1,2,3,4";
$fav1 = explode(",", $fav);
for ($i=0; $i < count($fav1); $i++)
{
    echo "Pos : ".$fav1[$i];
}
?>