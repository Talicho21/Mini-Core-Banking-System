<?php
/**
 * CORE BANKING SYSTEM - DASHBOARD DEMO MODE
 * This version uses Mock Data to show the UI on Vercel without a database.
 */

// 1. Create a Mock Result Class to simulate database rows
class MockResult {
    private $data;
    private $index = 0;

    public function __construct($data) {
        $this->data = $data;
    }

    public function fetch_assoc() {
        if ($this->index < count($this->data)) {
            return $this->data[$this->index++];
        }
        return null;
    }
}
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-slate-800/50 backdrop-blur-md p-6 rounded-2xl border border-blue-500/30 shadow-xl">
                <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Total Onboarded</p>
                <h3 class="text-4xl font-bold text-white mt-2">1,248</h3>
                <div class="mt-4 flex items-center text-green-400 text-sm">
                    <span>↑ 12% this month</span>
                </div>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-md p-6 rounded-2xl border border-purple-500/30 shadow-xl">
                <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">Active Branches</p>
                <h3 class="text-4xl font-bold text-white mt-2">14</h3>
                <div class="mt-4 text-slate-300 text-sm">
                    Main: Arba Minch & Addis
                </div>
            </div>

            <div class="bg-slate-800/50 backdrop-blur-md p-6 rounded-2xl border border-orange-500/30 shadow-xl">
                <p class="text-slate-400 text-sm font-medium uppercase tracking-wider">System Status</p>
                <h3 class="text-4xl font-bold text-green-400 mt-2">Online</h3>
                <div class="mt-4 flex items-center text-slate-300 text-sm">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></span>
                    Vercel Edge Network
                </div>
            </div>
        </div>

// 2. Create a Mock Connection Class
class MockConn {
    public function query($sql) {
        // Return Individual Mock Data
        if (strpos($sql, 'View_Individual_Clients') !== false) {
            return new MockResult([
                ['Client_ID' => 101, 'First_Name' => 'Yonatan', 'Last_Name' => 'Shitaye', 'Age' => 22, 'Branch_Code' => 'AMU01'],
                ['Client_ID' => 102, 'First_Name' => 'Kirubel', 'Last_Name' => 'Tesfaye', 'Age' => 23, 'Branch_Code' => 'AA05']
            ]);
        }
        // Return Corporate Mock Data
        if (strpos($sql, 'View_Corporate_Clients') !== false) {
            return new MockResult([
                ['Client_ID' => 5001, 'Company_Name' => 'Ethio Tech Solutions', 'Industry_Type' => 'Technology', 'Branch_Code' => 'AA01']
            ]);
        }
        return new MockResult([]);
    }
}

// Initialize the Mock Connection
$conn = new MockConn();
$ind_res = $conn->query("SELECT * FROM View_Individual_Clients");
$corp_res = $conn->query("SELECT * FROM View_Corporate_Clients");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Master Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white min-h-screen">
    
    <?php 
    // Only include navbar if the file exists in the /api folder
    if (file_exists('navbar.php')) {
        include 'navbar.php'; 
    }
    ?>

    <div class="max-w-6xl mx-auto p-6">
        <h1 class="inline-block text-3xl font-bold text-white bg-blue-600 px-4 py-2 rounded-xl shadow-lg mb-10">CORE BANKING SYSTEM</h1>

        <div class="mb-12">
            <h2 class="inline-block text-xl font-semibold mb-4 text-white bg-purple-600 px-4 py-2 rounded-lg shadow-md">Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-2xl">
                <table class="w-full text-left">
                    <thead class="bg-slate-700 text-slate-300">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Full Name</th>
                            <th class="p-4">Age</th>
                            <th class="p-4">Branch</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($row = $ind_res->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-700/50 transition-colors">
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
            <h2 class="inline-block text-xl font-semibold mb-4 text-white bg-orange-600 px-4 py-2 rounded-lg shadow-md">Non-Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden shadow-2xl">
                <table class="w-full text-left">
                    <thead class="bg-slate-700 text-slate-300">
                        <tr>
                            <th class="p-4">ID</th>
                            <th class="p-4">Company Name</th>
                            <th class="p-4">Industry</th>
                            <th class="p-4">Branch</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($row = $corp_res->fetch_assoc()): ?>
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="p-4"><?php echo $row['Client_ID']; ?></td>
                            <td class="p-4 font-bold"><?php echo $row['Company_Name']; ?></td>
                            <td class="p-4 text-orange-300"><?php echo $row['Industry_Type']; ?></td>
                            <td class="p-4 text-purple-400"><?php echo $row['Branch_Code']; ?></td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>
</html>