<?php

function comPrimo($numero) {
    if ($numero < 2) {
        return false;
    }
    for ($x = 2; $x <= sqrt($numero); $x++) {
        if ($numero % $x == 0) {
            return false;
        }
    }
    return true;
}

for ($n = 3; $n <= 999; $n++) {
    if (comPrimo($n)) {
        echo $n . " ";
    }
}


?>