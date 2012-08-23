<?php

class cssmin {
    
   static function minify($string) {
    /* Strips Comments */
    $string = preg_replace('!/\*.*?\*/!s', '', $string);
    $string = preg_replace('/\n\s*\n/', "\n", $string);

    /* Minifies */
    $string = preg_replace('/[\n\r \t]/', ' ', $string);
    $string = preg_replace('/ +/', ' ', $string);
    $string = preg_replace('/ ?([,:;{}]) ?/', '$1', $string);

    /* Kill Trailing Semicolon */
    $string = preg_replace('/;}/', '}', $string);
    return $string;
}
}

?>
