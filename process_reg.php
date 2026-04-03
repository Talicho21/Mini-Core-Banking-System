<?php
// 1. Database Connection
$conn = new mysqli("localhost", "root", "", "minicorebanking");

// We need to output HTML for the SweetAlert to work, so we start the structure here
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #0f172a; } /* Matches your dashboard background */
        .swal2-popup { background: #1e293b !important; color: white !important; border: 1px solid #334155 !important; }
        .swal2-title { color: #f8fafc !important; }
        .swal2-html-container { color: #94a3b8 !important; }
    </style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cat = $_POST['category'];
    $branch = $_POST['branch'];
    $status = "Active";

    // Step 1: Insert into Master Table
    $master_sql = "INSERT INTO Client_Master (Category, Branch_Code, Status) VALUES ('$cat', '$branch', '$status')";
    
    if ($conn->query($master_sql)) {
        $new_id = $conn->insert_id; 

        if ($cat == "Individual") {
            $sub    = $_POST['ind_sub_type'];
            $first  = $_POST['first_name'];
            $last   = $_POST['last_name'];
            $gender = $_POST['gender'] ?? "Not Specified";
            $dob    = $_POST['dob'];
            $id_num = $_POST['id_tax_no'];
            
            // CALL the procedure with all 7 arguments
            $sql = "CALL sp_RegisterIndividual($new_id, '$sub', '$first', '$last', '$gender', '$dob', '$id_num')";
        } else {
            // Corporate Logic
            $comp_name = $_POST['company_name'];
            $reg_no    = $_POST['reg_no'];
            $sub       = $_POST['corp_sub_type'];
                        $tax_id    = $_POST['id_tax_no'];

            // Resolve the actual registration-number column name from the table schema.
            // Some database versions use a slightly different column name, so we allow
            // a few common variants and pick the one that exists.
            $column_sql = "SELECT COLUMN_NAME 
                           FROM INFORMATION_SCHEMA.COLUMNS 
                           WHERE TABLE_SCHEMA = DATABASE() 
                             AND TABLE_NAME = 'client_non_individuals' 
                             AND COLUMN_NAME IN ('Registration_Number', 'Registration_No', 'Reg_No', 'RegistrationNumber') 
                           LIMIT 1";
            $column_result = $conn->query($column_sql);
            $registration_column = null;

            if ($column_result && $column_result->num_rows > 0) {
                $registration_column = $column_result->fetch_assoc()['COLUMN_NAME'];
            }

            $tax_column_sql = "SELECT COLUMN_NAME 
                               FROM INFORMATION_SCHEMA.COLUMNS 
                               WHERE TABLE_SCHEMA = DATABASE() 
                                 AND TABLE_NAME = 'client_non_individuals' 
                                 AND COLUMN_NAME IN ('Tax_ID', 'Tax_Id', 'TIN', 'TIN_Number', 'Tax_Number', 'Tax_Identification_Number', 'Id_Tax_No') 
                               LIMIT 1";
            $tax_column_result = $conn->query($tax_column_sql);
            $tax_column = null;

            if ($tax_column_result && $tax_column_result->num_rows > 0) {
                $tax_column = $tax_column_result->fetch_assoc()['COLUMN_NAME'];
            }

            if ($registration_column && $tax_column) {
                $sql = "INSERT INTO client_non_individuals (Client_ID, Company_Name, `$registration_column`, `$tax_column`, Sub_Type) 
                        VALUES ($new_id, '$comp_name', '$reg_no', '$tax_id', '$sub')";
            } else {
                $sql = null;
            }
        }

        // Step 2: Execute Detail Table Query and show Professional UI
        if ($sql && $conn->query($sql)) {
            // SUCCESS POPUP
            echo "<script>
                Swal.fire({
                    icon: 'success',
                    title: 'Registration Successful',
                    text: 'Client ID $new_id has been onboarded.',
                    confirmButtonColor: '#3b82f6',
                    timer: 3000
                }).then(() => {
                    window.location.href = 'dashboard.php';
                });
            </script>";
        } else {
            // FAILURE POPUP (Catches the Age < 18 Error from SQL)
            $error_msg = $sql ? $conn->error : 'Required database column for registration number was not found.';
            echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Registration Failed',
                    text: '" . addslashes($error_msg) . "',
                    confirmButtonColor: '#ef4444'
                }).then(() => {
                    window.history.back();
                });
            </script>";
        }
    } else {
        echo "Error in Master Table: " . $conn->error;
    }
}

echo '</body></html>';
?>