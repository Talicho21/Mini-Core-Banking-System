<?php
/**
 * CORE BANKING SYSTEM - VERCEL DEMO MODE
 * This version bypasses the local MySQL connection for presentation purposes.
 */

// 1. Database Connection - COMMENTED OUT FOR VERCEL DEMO
// $conn = new mysqli("localhost", "root", "", "minicorebanking");

// We start the HTML structure for SweetAlert2 to render correctly
echo '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #0f172a; font-family: sans-serif; } 
        .swal2-popup { background: #1e293b !important; color: white !important; border: 1px solid #334155 !important; }
        .swal2-title { color: #f8fafc !important; }
        .swal2-html-container { color: #94a3b8 !important; }
    </style>
</head>
<body>';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture the data from the form
    $cat = $_POST['category'] ?? 'Individual';
    $first = $_POST['first_name'] ?? 'Demo';
    $last = $_POST['last_name'] ?? 'User';
    $comp_name = $_POST['company_name'] ?? 'Demo Corp';
    $dob = $_POST['dob'] ?? '';

    // --- DEMO LOGIC START ---
    
    // We can still simulate the 18+ validation in PHP for the demo!
    $is_underage = false;
    if ($cat == "Individual" && !empty($dob)) {
        $birthDate = new DateTime($dob);
        $today = new DateTime();
        $age = $today->diff($birthDate)->y;
        if ($age < 18) { $is_underage = true; }
    }

    if ($is_underage) {
        // TRIGGER FAILURE (Simulating the Stored Procedure error)
        echo "<script>
            Swal.fire({
                icon: 'error',
                title: 'Registration Failed',
                text: 'Business Rule Violation: Client must be at least 18 years old to register.',
                confirmButtonColor: '#ef4444'
            }).then(() => {
                window.history.back();
            });
        </script>";
    } else {
        // TRIGGER SUCCESS (Simulating a successful DB Insert)
        $displayName = ($cat == "Individual") ? "$first $last" : $comp_name;
        $demo_id = rand(1000, 9999); // Generate a fake ID for the demo

        echo "<script>
            Swal.fire({
                icon: 'success',
                title: 'Registration Successful',
                text: 'Client ($displayName) has been onboarded with Demo ID: $demo_id',
                confirmButtonColor: '#3b82f6',
                timer: 4000
            }).then(() => {
                window.location.href = 'index.php'; 
            });
        </script>";
    }
    // --- DEMO LOGIC END ---
} else {
    // If someone tries to access this page directly without POST
    header("Location: index.php");
    exit();
}

echo '</body></html>';
?>