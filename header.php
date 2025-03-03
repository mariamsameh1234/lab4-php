<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<style>
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
}

.navbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #343a40;
    padding: 15px 20px;
    color: white;
}

.logo {
    font-size: 24px;
    font-weight: bold;
}

.navbar ul {
    list-style: none;
    margin: 0;
    padding: 0;
    display: flex;
}

.navbar ul li {
    margin: 0 10px;
}

.navbar ul li a {
    text-decoration: none;
    color: white;
    font-size: 16px;
    padding: 8px 12px;
    transition: 0.3s;
}

.navbar ul li a:hover {
    background-color: #495057;
    border-radius: 5px;
}

</style>
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
