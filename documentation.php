<?php
// HW8 - Airport API   Oswaldo Flores
require_once('util/main.php');
require('views/header.php') ?>
<a href="index.php">Upload a File</a>
<h2>API URL Structure</h2>
<ol>
<li>Base URL example: </li>
    <ul> <li>http://localhost/HW8</li> </ul>
<li>End point URL example: </li>
    <ul><li>/results</li></ul>
<li>Parameters (optional) example: </li>
    <ul><li>/?id=1,2,14111</li>
    <li>/?country=united_states&id=14111</li></ul>
<li>Full API Request example</li>
    <ul><li>http://localhost/HW8/results/?id=1,2,14111</li></ul>
</ol>
<p>If one of the parameters needs to contain a (,) put ("") around your words.</p>
<h2>Parameters</h2>
<p>Modify the URL to edit the parameters. This will specific which records to get.</p>
<p>The more specific you are in your parameters the fewer data you will retrieve.</p>
<ol>
    <li>Parameters List:</li>
    <ul>
        <li>id</li>
        <li>name</li>
        <li>city</li>
        <li>country</li>
        <li>type</li>
        <li>iata</li>
        <li>icao</li>
    </ul>
</ol>
<h2>Id</h2>
<p>Parameters: id=</p>
<p>Definition: Allows the user to see only one record. Each record will have a unique id.</p>
<p>Default: If ids are not specified, every record will be returned.</p>
<h2>Name</h2>
<p>Parameters: name=</p>
<p>Definition: The name of the port. Allows the user to see records of specific name.</p>
<p>Default: If names are not specified, every record will be returned.</p>
<h2>City</h2>
<p>Parameters: city=</p>
<p>Definition: The city location of the port. Allows the user to see records of specific cities.</p>
<p>Default: If cities are not specified, every record will be returned.</p>
<h2>Country</h2>
<p>Parameters: country=</p>
<p>Definition: The country location of the port. Allows the user to see records of specific countries.</p>
<p>Default: If countries are not specified, every record will be returned.</p>
<h2>Type</h2>
<p>Parameters: type=</p>
<p>Definition: Allows the user to see records of specific port types.</p>
<p>Default: If types are not specified, every record will be returned.</p>
<h2>IATA</h2>
<p>Parameters: iata=</p>
<p>Definition: 3-letter IATA code. Allows the user to see records of specific IATA codes.</p>
<p>Default: If IATA codes are not specified, every record will be returned.</p>
<h2>ICAO</h2>
<p>Parameters: icao=</p>
<p>Definition: 4-letter ICAO code. Allows the user to see records of specific ICAO codes.</p>
<p>Default: If ICAO codes are not specified, every record will be returned.</p>
<?php require('views/footer.php') ?>
