<?php
//first we make helper function then we autoload in our composer.json file
// then we run composer dump-autoload command on our terminal
// important function which are usable in our controller and blade files

function UC($string){
    return ucfirst($string);
}

function p($data){
    echo '<pre>';
    print_r($data);
    echo '</pre>';
}

?>