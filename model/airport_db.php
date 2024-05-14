<?php
// HW8 - Airport API   Oswaldo Flores

const INSERT_AIRPORT = 'INSERT INTO ports (id, name, city, country, type, iata, icao)
                        VALUES (:id, :name, :city, :country, :type, :iata, :icao)';

const SELECT_ONE_RECORD = 'SELECT id, name, city, country, type, iata, icao
                           From ports
                           LIMIT 1';

const SELECT_ALL = 'SELECT id, name, city, country, type, iata, icao
                    FROM ports';

const DELETE_ALL = 'DELETE FROM ports';

const MAXIMUM_COUNTER_LIMIT = 6;

const LAST_CHARACTER = -1;

/**
 * Open a file with a given file name. The file will not be saved because the data will
 * be saved in a database. If the user open up another file, I assume the user
 * want to delete the old data in the database.
 * @param mixed $tempFile <p>The name of the file</p>
 * @return bool - True if the file was open. False if the file was not open.
 */
function openFile(mixed $tempFile): bool{
    if ($tempFile !== ''){
        if (doesDatabaseContainData()){
            $rowCount = deleteDatabaseData();
        }
        if (($fileHandler = fopen($tempFile, 'r')) !== False)
        {
            while(($row = fgetcsv($fileHandler)) !== False)
            {
                insertAirport(Airport::newInstance($row));
            }
        }
        return True;
    }
    return False;
}

/**
 * If this function is called, I assume the data is valid.
 * @param Airport $airports <p>To insert the given object into a database.</p>
 * @return int - How many rows was inserted.
 */
function insertAirport(Airport $airports): int{
    $params = [
        ':id' => "{$airports->getId()}",
        ':name' => "{$airports->getName()}",
        ':city' => "{$airports->getCity()}",
        ':country' => "{$airports->getCountry()}",
        ':type' => "{$airports->getType()}",
        ':iata' => "{$airports->getIata()}",
        ':icao' => "{$airports->getIcao()}"
    ];

    return executeRowCount(INSERT_AIRPORT, $params);
}

/**
 * To determine if the database contains data.
 * @return bool - True if the database contains data. False if the database does not contain
 * data.
 */
function doesDatabaseContainData(): bool
{
    if(Count(execute(SELECT_ONE_RECORD)) !== 0){
        return True;
    }
    return False;
}

/**
 * To delete everything in the database. If this function is called, I assume
 * the user want to delete everything.
 * @return int - To get how many rows was affect.
 */
function deleteDatabaseData(): int
{
    return executeRowCount(DELETE_ALL);
}

/**
 * To parse the given data. The user might give nothing. The delimiter will have a default
 * value of a comma. I assume the user will use a comma. The default enclosure will be ". If a comma
 * is between two ", it means that comma belongs to that word. The default space is _. Space means
 * white space. Example, United_States = United States.
 *
 * @param string $data <p>Unfiltered data.</p>
 * @param string $delimiter <p>To separate a string</p>
 * @param string $enclosure <p>Words that can be enclose by</p>
 * @param string $space <p>Act similar to white spaces</p>
 * @return array|False - Array if data was filter. False if no data was filter.
 */
function filterData(string $data, string $delimiter = ',', string $enclosure = '"',
                    string $space = '_'): array|False{
    $validData = [];
    if($data !== ''){
        $isEnclosure = False;
        $line = '';
        foreach(str_split($data) as $character){
            $line = "{$line}{$character}";
            if($character === $enclosure){
                $isEnclosure = !$isEnclosure;
            } else if ($character === $delimiter && !$isEnclosure){
                $line = str_replace($space, ' ', $line);
                $line = str_replace($enclosure, '', $line);
                if($line !== '' && $line !== $delimiter){
                    $line = substr(trim($line), 0, LAST_CHARACTER);
                    $validData[] = $line;
                }
                $line = '';
            }
        }
        $line = str_replace($space, ' ', $line);
        $line = str_replace($enclosure, '', $line);
        if($line !== '' && $line !== $delimiter){
            $validData[] = $line;
        }
    }
    return Count($validData) !== 0 ? $validData : False;
}

/**
 * To filter a string that might contain id(s). The delimiter will have a default
 * value of a comma.
 * @param string $id <p>One id or multiple ids.</p>
 * @param string $delimiter <p>To separate a string</p>
 * @return array|False - Array if id(s) is given. False if no id were given.
 */
function filterId(string $id, string $delimiter = ','): array|False
{
    $validIds = [];
    if($id !== '') {
        $ids = explode($delimiter, $id);
        foreach ($ids as $key => $value) {
            if ((int)$value || $value === '0') {
                $validIds[] = $value;
            }
        }
    }
    return Count($validIds) !== 0 ? $validIds : False;
}

/**
 * Determine if the given data can be build into parameters to make a database call. Based on
 * the given bata build the query parameters part first. After building the parameters part,
 * build the SELECT clause. Building the whole query does not belong here it belongs to another
 * function. Execute the query and remove any duplicates. Removing the duplicates does not
 * happen here it happens in another function.
 *
 * @param array|False $id <p>An array of id(s). False if no ids were given.</p>
 * @param array|False $name <p>An array of the company or building name. False if no names were given</p>
 * @param array|False $city <p>An array of city names. False if no city names were given.</p>
 * @param array|False $country <p>An array of country. False if no countries were given.</p>
 * @param array|False $type <p>An array of the type of operation. False if no type were given.</p>
 * @param array|False $iata <p>An array of iata code. False if no iata codes were given.</p>
 * @param array|False $icao <p>An array of icao code. False if no icao codes were given.</p>
 * @return array - Data based on the given parameters.
 */
function selectPorts(array|False $id, array|False $name, array|False $city, array|False $country,
                     array|False $type, array|False $iata, array|False $icao): array{
    $idString = arrayToString($id);
    $nameString = arrayToString($name);
    $cityString = arrayToString($city);
    $countryString = arrayToString($country);
    $typeString = arrayToString($type);
    $iataString = arrayToString($iata);
    $icaoString = arrayToString($icao);
    $idString = $idString !== '' ? "id IN ({$idString})" : '';
    $nameString = $nameString !== '' ? "name IN ({$nameString})" : '';
    $cityString = $cityString !== '' ? "city IN ({$cityString})" : '';
    $countryString = $countryString !== '' ? "country IN ({$countryString})" : '';
    $typeString = $typeString !== '' ? "type IN ({$typeString})" : '';
    $iataString = $iataString !== '' ? "iata IN ({$iataString})" : '';
    $icaoString = $icaoString !== '' ? "icao IN ({$icaoString})" : '';
    $queryArray = [$idString, $nameString, $cityString, $countryString, $typeString, $iataString, $icaoString];
    $selectPorts = builderQuery($queryArray);
    $results = execute($selectPorts);
    return removeDuplicates($results);
}

/**
 * When I first run my code, I realize I was getting duplicates. Small example of the data I was
 * getting {['0':1, '1':Name1, 'id':1, 'name':Name1], ['0':2, '1':Name2, 'id':2, 'name':Name2]}.
 * I went back to my database and my database does not contain duplicate data. So I decided to remove
 * every duplicate data. It was easy to remove the duplicate data because every duplicate will
 * contain an integer as the key.
 *
 * @param array $results <p>An array of duplicate data.</p>
 * @return array - An array of zero duplicate data.
 */
function removeDuplicates(array $results): array{
    foreach ($results as $key => $value) {
        $counter = 0;
        foreach($value as $uniqueKey => $items){
            if($counter <= MAXIMUM_COUNTER_LIMIT) {
                unset($results[$key]["{$counter}"]);
                $counter += 1;
            }
        }
    }
    return $results;
}

/**
 * The given parameters will determine what the query should look like. It is okay if the
 * given params does not contain data. If this happens, I assume the user want every data
 * in the database.
 *
 * @param array $params <p>An array of parameters.</p>
 * @return string - A query for a SELECT statement.
 */
function builderQuery(array $params): string{
    $selectPorts = '';
    foreach ($params as $key => $value){
        if($selectPorts === '' && $value !== ''){
            $selectPorts = SELECT_ALL;
            $selectPorts = "{$selectPorts} WHERE {$value}";
        } else if ($selectPorts !== '' && $value !== ''){
            $selectPorts = "{$selectPorts} and {$value}";
        }
    }
    if ($selectPorts === ''){
        $selectPorts = SELECT_ALL;
    }
    return $selectPorts;
}

/**
 * To convert an array to a string. Each value in the array will get seperated by a
 * delimiter in string form. This will cause a delimiter to be located at the end of
 * every completed string. So I decided to remove that delimiter.
 *
 * @param array|False $data <p>An array if it contains data. False means no data.</p>
 * @return string - A string based on the given data. The string can be empty.
 */
function arrayToString(array|False $data): string{
    $dataString = '';
    if($data !== False) {
        foreach ($data as $key => $value) {
            $dataString = "'{$value}',{$dataString}";
        }
    }
    return substr(trim($dataString), 0, LAST_CHARACTER);
}

