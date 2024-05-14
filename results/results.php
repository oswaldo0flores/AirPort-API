<?php
// HW8 - Airport API   Oswaldo Flores
if(isset($results)) {
    header('Content-Type: application/json; charset=utf-8');
    $json = json_encode($results, JSON_UNESCAPED_SLASHES|JSON_UNESCAPED_UNICODE);
    echo $json;
}
