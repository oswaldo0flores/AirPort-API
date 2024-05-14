<?php
// HW8 - Airport API   Oswaldo Flores

$dsn = 'mysql:host=localhost;dbname=airport_extended';
$username = 'root';
$password = '';

$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $pDOException) {
    $errorMessage = $pDOException->getMessage();
    # require('../error/database_error.php');
    exit();
}

/**
 * <p>It is okay if I retrieve nothing from the database. It means the given parameters does
 * not exist within the database. Params has a default value because The given query might
 * require zero parameters to get the data. Displaying the error message does not happen here.
 * Display the error message happens in the error directory.</p>
 * @param string $query <p>An query to get data from a database.</p>
 * @param array $params <p>The parameters to set the query</p>
 * @param string $errorMessage <p>A message to get to the user in case of an error.</p>
 * @return array - Data that was retrieve from the database.
 */
function execute(string $query, array $params = [], string $errorMessage = 'Error!!'): array
{
    global $db;
    try {
        $statement = $db->prepare($query);
        foreach ($params as $paramName => $paramValue) {
            $statement->bindValue($paramName, $paramValue);
        }
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $pDOException) {
        displayError($errorMessage);
    }
}

/**
 * <p>It is okay if I affect nothing in the database. It means the given parameters does
 * not exist within the database. Params has a default value because The given query might
 * require zero parameters to affect the data. Displaying the error message does not happen here.
 * Display the error message happens in the error directory.</p>
 * @param string $query <p>An query to affect the database.</p>
 * @param array $params <p>The parameters to set the query</p>
 * @param string $errorMessage <p>A message to get to the user in case of an error.</p>
 * @return int - How many rows were affected by the query.
 */
function executeRowCount(string $query, array $params = [], string $errorMessage = 'Error!!'): int
{
    global $db;
    try {
        $statement = $db->prepare($query);
        foreach ($params as $paramName => $paramValue) {
            $statement->bindValue($paramName, $paramValue);
        }
        $statement->execute();
        $result = $statement->rowCount();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $pDOException) {
        displayError($errorMessage);
    }
}

/**
 * <p>If this function is called display the error message and stop the application.</p>
 * @param string $errorMessage <p>A message about an error.</p>
 * @return void
 */
function displayError(string $errorMessage) {
    require('../error/error.php');
    exit();
}
