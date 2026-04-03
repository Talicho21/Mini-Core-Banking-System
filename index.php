<?php
$conn = new mysqli("localhost", "root", "", "minicorebanking");
$ind_res = $conn->query("SELECT * FROM View_Individual_Clients");
$corp_res = $conn->query("SELECT * FROM View_Corporate_Clients");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Bank Master Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white p-6">
    <body class="bg-slate-900 text-white">
    <?php include 'navbar.php'; ?> <div class="max-w-6xl mx-auto p-6">
        </div>
</body>
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-blue-500 mb-10">CORE BANKING SYSTEM</h1>

        <div class="mb-12">
            <h2 class="text-xl font-semibold mb-4 text-purple-400">Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-700 text-slate-300">
                        <tr><th class="p-4">ID</th><th class="p-4">Full Name</th><th class="p-4">Age</th><th class="p-4">Branch</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($row = $ind_res->fetch_assoc()): ?>
                       <tr class="hover:bg-slate-700/50">
    <td class="p-4"><?php echo $row['Client_ID']; ?></td>
    <td class="p-4 font-bold"><?php echo $row['First_Name'] . " " . $row['Last_Name']; ?></td>
    <td class="p-4 text-blue-300"><?php echo $row['Age']; ?>yrs</td> 
    <td class="p-4 text-purple-400"><?php echo $row['Branch_Code']; ?></td>
</tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <h2 class="text-xl font-semibold mb-4 text-orange-400">Non-Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-700 text-slate-300">
                        <tr><th class="p-4">ID</th><th class="p-4">Company Name</th><th class="p-4">Industry</th><th class="p-4">Branch</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($row = $corp_res->fetch_assoc()): ?>
                        <tr>
                            <td class="p-4"><?php echo $row['Client_ID']; ?></td>
                            <td class="p-4 font-bold"><?php echo $row['Company_Name']; ?></td>
                            <td class="p-4"><?php echo $row['Industry_Type']; ?></td>
                            <td class="p-4"><?php echo $row['Branch_Code']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>