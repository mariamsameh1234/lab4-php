<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

<?php if (isset($_SESSION['user'])): ?>
    <nav class="navbar">
        <div class="logo">Cafeteria</div>
        <ul>
            <li><a href="#">Home</a></li>
            <li><a href="#">products</a></li>
            <li><a href="#">Users</a></li>
            <li><a href="#">monual order</a></li>
            <li><a href="#">checks</a></li>
        </ul>
    </nav>
<?php endif; ?>
