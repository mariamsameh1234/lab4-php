
<header>
    <link rel="stylesheet" href="style.css">
</header>
<?php
session_start();
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
include 'header.php';
include 'datebase.php';

$stmt = $pdo->query("
    SELECT users.id, users.name, users.email, users.profile_picture, rooms.name AS room_name 
    FROM users 
    JOIN rooms ON users.room_id = rooms.id
    ORDER BY users.id DESC
");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>All Users</title>
</head>
<body>
<h2>All Users</h2>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Room</th>
        <th>Profile Picture</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($users as $user): ?>
        <tr>
            <td><?= htmlspecialchars($user['id']) ?></td>
            <td><?= htmlspecialchars($user['name']) ?></td>
            <td><?= htmlspecialchars($user['email']) ?></td>
            <td><?= htmlspecialchars($user['room_name']) ?></td>
            <td>
                <?php if (!empty($user['profile_picture'])): ?>
                    <img src="uploads/<?= htmlspecialchars($user['profile_picture']) ?>" alt="Profile" width="50">
                <?php else: ?>
                    <img src="uploads/default.png" alt="Default" width="50">
                <?php endif; ?>
            </td>
            <td>
                <a href="add_user.php?id=<?= $user['id'] ?>">Update</a>
                | <a href="delete_user.php?id=<?= $user['id'] ?>" onclick="return confirm('Are you sure?')">Delete</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>

<?php
include 'footer.php';
?>
