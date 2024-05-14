<?php
// HW8 - Airport API   Oswaldo Flores
require_once('util/main.php');
require_once('model/airport.php');
require_once('model/db.php');
require_once('model/airport_db.php');

const ACTION = 'action';
const DEFAULT_ACTION = 'file_upload';
const DATA_FILE_ACTION = 'data_file';

$action = filter_input(INPUT_POST, ACTION);
if ($action == NULL) {
    $action = filter_input(INPUT_GET, ACTION);
    if ($action == NULL) {
        $action = DEFAULT_ACTION;
    }
}

switch($action){
    case DEFAULT_ACTION:
        $doesDatabaseContainData = doesDatabaseContainData();
        require('file_upload.php');
        break;
    case DATA_FILE_ACTION:
        $file = filter_input(INPUT_POST, 'data_files');
        $tempFile = $_FILES['data_files']['tmp_name'];
        $hasData = openFile($tempFile);
        $doesDatabaseContainData = doesDatabaseContainData();
        require('file_upload.php');
        break;
}

//CREATE DATABASE airport_extended;
//USE airport_extended;
//CREATE TABLE ports
//(
//    id INT PRIMARY KEY,
//    name VARCHAR(100),
//    city VARCHAR(200),
//    country VARCHAR(200),
//    type VARCHAR(200),
//    iata VARCHAR(30),
//    icao VARCHAR(30)
//);
