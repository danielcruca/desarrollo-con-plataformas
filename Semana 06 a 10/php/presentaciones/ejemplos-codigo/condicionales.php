<?php
	$numero = 15;
	if($numero > 10){
		echo "Número positivo";
	}
    
?>



<?php

 	$numero = 15;
     if($numero != 0){
         echo "Número es diferente de cero";
     }else{
         echo "Número es cero";
     }
 
    
?>



<?php

     // buena practica.
	$numero = 15;
	if($numero == 0){
		echo "Número es diferente de cero";
	}elseif($numero > 0){
		echo "Número es mayor a cero";
	}else{
		echo "Número es menor a cero";
	}


    // mala practica.
	$numero = 15;
	if($numero == 0){
		echo "Número es diferente de cero";
	}
    
    if($numero > 0){
		echo "Número es mayor a cero";
	}else{
		echo "Número es menor a cero";
	}

?>
