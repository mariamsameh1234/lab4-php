<?php
include_once 'datebase.php';

function insert_user($pdo, $name, $email, $password, $room_id, $ext, $profile_picture) {
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    return insert($pdo, "users", ["name", "email", "password", "room_id", "ext", "profile_picture"], [$name, $email, $hashed_password, $room_id, $ext, $profile_picture]);
}


function get_all_rooms($pdo) {
    return selectAll($pdo, "rooms");
}

function get_all_users($pdo) {
    return select($pdo, "users LEFT JOIN rooms ON users.room_id = rooms.id", ["users.*", "rooms.name AS room_name"], "", []);
}

function get_user($pdo, $id) {
    $columns = ["name", "email", "ext", "room_id", "profile_picture"];
    $condition = "id = ?";
    return select($pdo, "users", $columns, $condition, [$id]);  
}


function update_user($pdo, $id, $name, $email, $room_id, $ext) {
    try {
        $sql = "UPDATE users SET name = :name, email = :email, room_id = :room_id, ext = :ext WHERE id = :id";
        $stmt = $pdo->prepare($sql);
        return $stmt->execute([
            ':name' => $name,
            ':email' => $email,
            ':room_id' => $room_id,
            ':ext' => $ext,
            ':id' => $id
        ]);
    } catch (PDOException $e) {
        die(" Error updating user: " . $e->getMessage());
    }
}     

function delete_user($pdo, $id) {
    return delete($pdo, "users", "id = ?", [$id]); 
}

?>


