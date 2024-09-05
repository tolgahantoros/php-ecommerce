<?php 
$a=['a' => 1,'b' => 2,'c' => 3];
echo "<pre>";
function addValue($degerler){
	$values = implode(',',array_map(function ($item){

		return $item.'=?';

	},array_keys($degerler)));
	return $values;
}
echo addValue($a);
?>