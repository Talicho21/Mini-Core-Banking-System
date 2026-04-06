<?php
$conn = new mysqli("localhost", "root", "", "minicorebanking");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat = $_POST['category'];
    $branch = $_POST['branch'];
    
    // 1. Create the Master Record first
    $master_sql = "INSERT INTO Client_Master (Category, Branch_Code, Status) VALUES ('$cat', '$branch', 'Active')";
    
    if ($conn->query($master_sql)) {
        $new_id = $conn->insert_id; // Get the auto-generated ID

        if ($cat == "Individual") {
            // 2. Capture all form data including Gender
            $first  = $_POST['first_name'];
            $last   = $_POST['last_name'];
            $gender = $_POST['gender'] ?? "Not Specified";
            $dob    = $_POST['dob'];
            $sub    = $_POST['ind_sub_type'];
            $id_num = $_POST['id_tax_no'];
            
            // 3. CALL the procedure with the new Gender parameter
            $sql = "CALL sp_RegisterIndividual($new_id, '$sub', '$first', '$last', '$gender', '$dob', '$id_num')";
            
           if ($conn->query($sql)) {
    // Change this from index.php to dashboard.php
    header("Location: dashboard.php");
    exit();
}
        }
    }
}
?>