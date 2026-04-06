<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Client Registration | Core Banking</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            background: linear-gradient(rgba(15, 23, 42, 0.8), rgba(15, 23, 42, 0.85)), 
                        url('image.jpg'); 
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            min-height: 100vh;
        }
        .glass-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
    </style>
    <script>
        function toggleFields(category) {
            const individualFields = document.getElementById('individual_fields');
            const corporateFields = document.getElementById('corporate_fields');
            const genderField = document.getElementById('gender');

            if (category === 'Individual') {
                individualFields.style.display = 'block';
                corporateFields.style.display = 'none';
                if(genderField) genderField.required = true;
            } else if (category === 'Non-Individual') {
                individualFields.style.display = 'none';
                corporateFields.style.display = 'block';
                if(genderField) genderField.required = false;
            } else {
                individualFields.style.display = 'none';
                corporateFields.style.display = 'none';
            }
        }

        function validateDob(input) {
            const dobHint = document.getElementById('dob_hint');
            if (!input) return;

            const selectedDate = input.value ? new Date(input.value) : null;
            const maxDate = input.max ? new Date(input.max) : null;

            if (selectedDate && maxDate && selectedDate > maxDate) {
                input.setCustomValidity('');
                dobHint.textContent = 'Please select a date on or before ' + input.max + '. The client must be at least 18 years old.';
                dobHint.classList.remove('hidden');
                input.setCustomValidity('The client must be at least 18 years old.');
            } else {
                input.setCustomValidity('');
                dobHint.textContent = 'The client must be 18 years or older.';
                dobHint.classList.remove('hidden');
            }
        }

        window.addEventListener('DOMContentLoaded', () => {
            const dobInput = document.querySelector('input[name="dob"]');
            if (dobInput) {
                dobInput.addEventListener('input', () => validateDob(dobInput));
                dobInput.addEventListener('blur', () => validateDob(dobInput));
                validateDob(dobInput);
            }
        });
    </script>
</head>
<body class="text-white">

    <?php include 'navbar.php'; ?>

    <div class="max-w-xl mx-auto mt-10 mb-10 p-8 rounded-3xl glass-card shadow-2xl">
        <a href="dashboard.php" class="text-blue-400 hover:text-blue-300 text-sm mb-4 inline-block transition">
            ← Back to Dashboard
        </a>
        
        <h2 class="text-3xl font-bold mb-6 text-white">Register New Client</h2>

        <form action="process_reg.php" method="POST" class="space-y-5">
            <div>
                <label class="block text-gray-400 text-sm mb-2">Client Category</label>
                <select name="category" onchange="toggleFields(this.value)" 
                        class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500 transition" required>
                    <option value="">Select Category</option>
                    <option value="Individual">Individual (Person)</option>
                    <option value="Non-Individual">Non-Individual (Organization)</option>
                </select>
            </div>

            <div id="individual_fields" style="display:none;" class="space-y-4">
                <div>
                    <label class="block text-gray-400 text-sm mb-2">Gender</label>
                    <select id="gender" name="gender" 
                            class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                        <option value="" selected disabled>Select Gender</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <input type="text" name="first_name" placeholder="First Name" 
                           class="p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                    <input type="text" name="last_name" placeholder="Last Name" 
                           class="p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-400 text-sm mb-2">Date of Birth (Must be 18+)</label>
                    <input type="date" name="dob" 
                           max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>" 
                           oninvalid="this.setCustomValidity('Please select a date on or before <?php echo date('Y-m-d', strtotime('-18 years')); ?>. The client must be at least 18 years old.')"
                           oninput="this.setCustomValidity(''); validateDob(this);"
                           class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                    <p id="dob_hint" class="mt-2 text-xs text-slate-300">The client must be 18 years or older.</p>
                </div>

                <select name="ind_sub_type" class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                    <option value="" selected disabled>Select Individual Sub Type</option>
                    <option value="Staff">Staff</option>
                    <option value="Minor">Minor</option>
                    <option value="Student">Student</option>
                    <option value="Adult">Adult</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div id="corporate_fields" style="display:none;" class="space-y-4">
                <input type="text" name="company_name" placeholder="Company/NGO Name" 
                       class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                <input type="text" name="reg_no" placeholder="Registration Number" 
                       class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                <select name="corp_sub_type" class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500">
                    <option value="" selected disabled>Select Organization Type</option>
                    <option value="NGO">NGO</option>
                    <option value="Corporate">Corporate</option>
                    <option value="Cooperative">Cooperative</option>
                    <option value="Association">Association</option>
                    <option value="Foundation">Foundation</option>
                    <option value="Bank">Bank</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="pt-2 border-t border-slate-700">
                <label class="block text-gray-400 text-sm mb-2">Identification & Location</label>
                <div class="space-y-4">
                    <input type="text" name="id_tax_no" placeholder="TIN / ID Number" 
                           class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500" required>
                    <input type="text" name="branch" placeholder="Branch (e.g. BOLE, ADAMA)" 
                           class="w-full p-3 bg-slate-800/50 rounded-lg border border-slate-600 outline-none focus:border-blue-500" required>
                </div>
            </div>

            <button type="submit" 
                    class="w-full bg-blue-600 hover:bg-blue-500 text-white py-4 rounded-xl font-bold mt-6 shadow-lg transform active:scale-95 transition-all">
                Create Client Record
            </button>
        </form>
    </div>

</body>
</html>