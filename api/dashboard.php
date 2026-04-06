<!DOCTYPE html>
<html>
<head>
    <title>Bank Management System</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white p-10 font-sans">
    <?php include 'navbar.php'; ?>
    <div class="max-w-4xl mx-auto grid grid-cols-1 gap-10 mt-12">
        <h1 class="text-4xl font-extrabold text-white bg-blue-600 mb-8 text-center uppercase tracking-tighter inline-block mx-auto px-6 py-2 rounded-xl">Core Banking System</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 shadow-2xl">
                <h2 class="text-2xl font-bold mb-4">New Client Onboarding</h2>
                <p class="text-gray-400 mb-6">Register Individuals (KYC) or Corporate/NGO entities.</p>
                <a href="register.php" class="block text-center bg-blue-600 hover:bg-blue-500 py-4 rounded-xl font-bold transition-all">Start Registration</a>
            </div>

            <div class="bg-gray-800 p-8 rounded-3xl border border-gray-700 shadow-2xl">
                <h2 class="text-2xl font-bold mb-4">Account Registered</h2>
                <p class="text-gray-400 mb-6">View All  statements for both Individual and Corporate existing Registered clients.</p>
                <a href="index.php" class="block text-center bg-emerald-600 hover:bg-emerald-500 py-4 rounded-xl font-bold transition-all">Open Teller View</a>
            </div>
        </div>
    </div>
</body>
</html>