<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "project";
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if(isset($_GET['id'])) {
        $user_id = $_GET['id'];
        $sql = "SELECT * FROM reginfo WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            $response = array(
                'success' => true,
                'name' => $row['name'],
                'email' => $row['email']
            );
        } else {
            $response = array('success' => false, 'message' => 'User not found.');
        }
        echo json_encode($response); 
    } else {
        echo json_encode(array('success' => false, 'message' => 'ID parameter is missing.'));
    }
    exit;
}
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo($_SERVER['REQUEST_METHOD']);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $dob = $_POST['dob'];
    $contactno = $_POST['contactno'];
    $gender = $_POST['gender'];

 
    $stmt = $conn->prepare("INSERT INTO profileinfo (name, email, age, dob, contactno, gender) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $name, $email, $age, $dob, $contactno, $gender);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success'>Your profile successfully saved</div>";
    } else {
        echo "<div class ='alert alert-danger'>Error </div> " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Error: Form not submitted using POST method";
}

$conn->close();
?>



