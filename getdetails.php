<?php


$conn = new mysqli('localhost', 'root', 'basil2004', 'student_portal');

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

session_start();
$username = $_SESSION['username'];


$stmt = $conn->prepare("SELECT id, name, email, phone, address FROM students WHERE username=?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Student Details</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f5f5f5;
    }

    header {
      background-color: #007bff;
      color: #fff;
      padding: 1rem;
      text-align: center;
      margin-bottom: 2rem;
    }

    main {
      display: flex;
      justify-content: center;
    }

    .container {
      width: 80%;
    }

    h2 {
      margin-bottom: 1rem;
      font-size: 2rem;
      color: #333;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      background-color: #fff;
      border-radius: 4px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    th, td {
      padding: 1rem;
      border: 1px solid #ccc;
      text-align: left;
      font-size: 1rem;
    }

    th {
      background-color: #333;
      color: #fff;
      border-top-left-radius: 4px;
      border-top-right-radius: 4px;
    }

    tbody tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    tbody tr:first-child {
      background-color: #333;
      color: #fff;
    }

    tbody tr:last-child {
      border-bottom-left-radius: 4px;
      border-bottom-right-radius: 4px;
    }

    a {
      display: inline-block;
      padding: 0.5rem 1rem;
      background-color: #333;
      color: #fff;
      text-decoration: none;
      border-radius: 4px;
      transition: background-color 0.3s;
    }

    a:hover {
      background-color: #444;
    }
  </style>
</head>
<body>
  <header>
    <h1>Student Details</h1>
  </header>
  <main>
    <div class="container">
      <h2>Student Details</h2>
      <table>
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Address</th>
          </tr>
        </thead>
        <tbody>
          <!-- PHP Loop for Table Rows -->
          <?php while ($row = $result->fetch_assoc()) {?>
            <tr>
              <td><?php echo $row['id'];?></td>
              <td><?php echo $row['name'];?></td>
              <td><?php echo $row['email'];?></td>
              <td><?php echo $row['phone'];?></td>
              <td><?php echo $row['address'];?></td>
            </tr>
          <?php }?>
          <!-- End of PHP Loop -->
        </tbody>
      </table>
      <p><a href="dashboard.html">Back to Dashboard</a></p>
    </div>
  </main>
</body>
</html>