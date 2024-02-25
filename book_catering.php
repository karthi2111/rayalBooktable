<?php
// Connect to MySQL database
$servername = "localhost"; // Replace with your server address
$username = "root"; // Replace with your username
$password = ""; // Replace with your password
$database = "rayal_restaurant"; // Replace with your database name

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Process form submission from book_table.html
  

    // Process form submission from catering_Form.html
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST["fname"];
        $city = $_POST["lname"];
        $email = $_POST["mailid"];
        $phone = $_POST["phone"];
        $fullMealsVeg = isset($_POST["Check1"]) && $_POST["Check1"] == "on";
        $fullMealsNonVeg = isset($_POST["Check2"]) && $_POST["Check2"] == "on";
        $biryani = isset($_POST["Check3"]) && $_POST["Check3"] == "on";
        $fullMealsVegPersons = intval($_POST["Check1_quantity"] ?? 0);
        $fullMealsNonVegPersons = intval($_POST["Check2_quantity"] ?? 0);
        $biryaniPersons = intval($_POST["Check3_quantity"] ?? 0);
        
        try {
            $stmt = $conn->prepare("INSERT INTO catering (name, city, email, phone, full_meals_veg, no_of_persons_full_meals_veg, full_meals_non_veg, no_of_persons_full_meals_non_veg, biryani, no_of_persons_biryani) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$name, $city, $email, $phone, $fullMealsVeg, $fullMealsVegPersons, $fullMealsNonVeg, $fullMealsNonVevPersons, $biryani, $biryaniPersons]);
            echo "<p>Your request was submitted successfully.</p>";
        } catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }
} catch(\PDOException $e) {
    die("<p>Connection failed: " . $e->getMessage() . "</p>");
}
?>