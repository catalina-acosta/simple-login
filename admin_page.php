<?php

session_start();
if (!isset($_SESSION['email'])) {
    header("Location:index.php");
    exit();
}

require_once "config.php";

$allusersquery = "SELECT name, email, role FROM users";
$result = $conn->query($allusersquery);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin page</title>
    <link rel="stylesheet" href="./styles.css">
</head>
<body style="background: #fff:">
    <div class="box">
        <h1>Welcome, <span><?= $_SESSION['name'];?></span></h1>
        <p>This is an <span>admin</span> page </p>
        <button onclick="window.location.href='logout.php'">Logout</button>
        <div class="users-display">
            <h2>All Users</h2>
            <table>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                </tr>
                <?php if ($result && $result->num_rows > 0): ?> 
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['name']); ?></td>
                            <td><?= htmlspecialchars($row['email']); ?></td>
                            <td><?= htmlspecialchars($row['role']); ?></td>
                            <!-- <td>edit role</td> -->
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td>No users found.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>
</body>
</html>