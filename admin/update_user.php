<?php
// Assuming you have a valid database connection
header('Content-Type: application/json');
$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['id'], $input['name'], $input['phone_no'], $input['email'], $input['address'], $input['privilege'])) {
    // You can use these variables in your SQL query
    $id = $input['id'];
    $name = $input['name'];
    $phone_no = $input['phone_no'];
    $email = $input['email'];
    $address = $input['address'];
    $privilege = $input['privilege'];

    // Update query example
    $query = "UPDATE users SET name = ?, phone_no = ?, email = ?, address = ?, privilege = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssssi", $name, $phone_no, $email, $address, $privilege, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'User updated successfully']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update user']);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid input']);
}
?>
