<?php
// HW8 - Airport API   Oswaldo Flores

require_once('../model/airport.php');
require_once('../model/db.php');
require_once('../model/airport_db.php');

const ACTION = 'action';
const DEFAULT_ACTION = 'json';

$action = filter_input(INPUT_POST, ACTION);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, ACTION);
    if ($action == NULL) {
        $action = DEFAULT_ACTION;
    }
}

switch($action){
    case DEFAULT_ACTION:
        $id = filter_input(INPUT_GET, 'id');
        $id = $id !== null ? $id : '';
        $name = filter_input(INPUT_GET, 'name');
        $name = $name !== null ? $name : '';
        $city = filter_input(INPUT_GET, 'city');
        $city = $city !== null ? $city : '';
        $country = filter_input(INPUT_GET, 'country');
        $country = $country !== null ? $country : '';
        $type = filter_input(INPUT_GET, 'type');
        $type = $type !== null ? $type : '';
        $iata = filter_input(INPUT_GET, 'iata');
        $iata = $iata !== null ? $iata : '';
        $icao = filter_input(INPUT_GET, 'icao');
        $icao = $icao !== null ? $icao : '';
        $id = filterId($id);
        $name = filterData($name);
        $city = filterData($city);
        $country = filterData($country);
        $type = filterData($type);
        $iata = filterData($iata);
        $icao = filterData($icao);
        $results = selectPorts($id, $name, $city, $country, $type, $iata, $icao);
        require('results.php');
        break;
}
