<?php
// Mock Classes
class MockResult {
    private $data;
    private $index = 0;
    public function __construct($data) { $this->data = $data; }
    public function fetch_assoc() {
        if ($this->index < count($this->data)) { return $this->data[$this->index++]; }
        return null;
    }
}

class MockConn {
    public function query($sql) {
        if (strpos($sql, 'Individual') !== false) {
            return new MockResult([
                ['Client_ID' => 101, 'First_Name' => 'Yonatan', 'Last_Name' => 'Shitaye', 'Age' => 22, 'Branch_Code' => 'AMU01'],
                ['Client_ID' => 102, 'First_Name' => 'Kirubel', 'Last_Name' => 'Tesfaye', 'Age' => 23, 'Branch_Code' => 'AA05']
            ]);
        }
        return new MockResult([
            ['Client_ID' => 5001, 'Company_Name' => 'Ethio Tech Solutions', 'Industry_Type' => 'Technology', 'Branch_Code' => 'AA01']
        ]);
    }
}

$conn = new MockConn();
$ind_res = $conn->query("SELECT * FROM View_Individual_Clients");
$corp_res = $conn->query("SELECT * FROM View_Corporate_Clients");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Bank Master Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 text-white min-h-screen p-6">
    <div class="max-w-6xl mx-auto">
        
        <div class="flex justify-between items-center mb-10">
            <h1 class="text-3xl font-bold bg-blue-600 px-6 py-3 rounded-2xl shadow-xl">CORE BANKING SYSTEM</h1>
            <div class="text-right">
                <p class="text-slate-400 text-sm">System Status</p>
                <p class="text-green-400 font-bold flex items-center">
                    <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse mr-2"></span> LIVE DEMO
                </p>
            </div>
        </div>

        <div class="mb-12">
            <h2 class="text-xl font-semibold mb-4 bg-purple-600 inline-block px-4 py-2 rounded-lg">Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-700">
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
            <h2 class="text-xl font-semibold mb-4 bg-orange-600 inline-block px-4 py-2 rounded-lg">Non-Individual Clients</h2>
            <div class="bg-slate-800 rounded-xl border border-slate-700 overflow-hidden">
                <table class="w-full text-left">
                    <thead class="bg-slate-700">
                        <tr><th class="p-4">ID</th><th class="p-4">Company Name</th><th class="p-4">Industry</th><th class="p-4">Branch</th></tr>
                    </thead>
                    <tbody class="divide-y divide-slate-700">
                        <?php while($row = $corp_res->fetch_assoc()): ?>
                        <tr>
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