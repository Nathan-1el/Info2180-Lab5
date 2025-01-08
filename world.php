<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

$country = isset($_GET['country']) ? $_GET['country'] : '';
$cities = isset($_GET['cities']) ? $_GET['cities'] === 'true' : false;

if ($cities && $country) {
    
    $stmt = $conn->prepare(
        "SELECT cities.name AS city_name, cities.district, cities.population
         FROM cities
         INNER JOIN countries ON cities.country_code = countries.code
         WHERE countries.name LIKE :country"
    );
    $stmt->execute([':country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
                <tr>
                    <th>City Name</th>
                    <th>District</th>
                    <th>Population</th>
                </tr>
            </thead>
            <tbody>";
    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['city_name']) . "</td>
                    <td>" . htmlspecialchars($row['district']) . "</td>
                    <td>" . htmlspecialchars($row['population']) . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>No cities found for this country.</td></tr>";
    }
    echo "</tbody></table>";
} elseif ($country) {

    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute([':country' => "%$country%"]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>";
    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['continent']) . "</td>
                    <td>" . htmlspecialchars($row['independence_year']) . "</td>
                    <td>" . htmlspecialchars($row['head_of_state']) . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No countries found.</td></tr>";
    }
    echo "</tbody></table>";
} else {
    
    $stmt = $conn->query("SELECT * FROM countries");
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "<table>
            <thead>
                <tr>
                    <th>Country Name</th>
                    <th>Continent</th>
                    <th>Independence Year</th>
                    <th>Head of State</th>
                </tr>
            </thead>
            <tbody>";
    if (!empty($results)) {
        foreach ($results as $row) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['name']) . "</td>
                    <td>" . htmlspecialchars($row['continent']) . "</td>
                    <td>" . htmlspecialchars($row['independence_year']) . "</td>
                    <td>" . htmlspecialchars($row['head_of_state']) . "</td>
                </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>No countries found.</td></tr>";
    }
    echo "</tbody></table>";
}
?>
