<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
$stmt = $conn->query("SELECT * FROM countries");

// Get the 'country' parameter from the GET request, if provided
$country = isset($_GET['country']) ? $_GET['country'] : '';


// Prepare SQL query to fetch data based on the country parameter
if ($country) {
  $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
  $stmt->execute([':country' => "%$country%"]);
} else {
  $stmt = $conn->query("SELECT * FROM countries");
}

$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<table>
  <thead>
    <tr>
      <th>Country Name </th>
      <th> Continent </th>
      <th>Independece Year</th>
      <th>Head of State</th>
    </tr>
  </thead>
  <tbody>
  <?php if (!empty($results)): ?>
    <?php foreach ($results as $row): ?>

    <tr>
      <td> <?= $row['name'];?> </td>
      <td> <?= $row['continent'];?> </td>
      <td> <?= $row['independence_year'];?> </td>
      <td> <?= $row['head_of_state']; ?> </td>
    </tr>

    <?php endforeach; ?>
  <?php else: ?>
    <tr> 
      <td>No result found</td>
    </tr>
  <?php endif; ?>

  </tbody>
</table>
