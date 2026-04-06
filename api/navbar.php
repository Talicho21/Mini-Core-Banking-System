<nav class="bg-slate-800 p-4 border-b border-slate-700 shadow-lg">
    <div class="max-w-6xl mx-auto flex justify-between items-center">
        <div class="text-blue-500 font-bold text-xl tracking-tight">CORE BANKING</div>
        
        <div class="flex gap-6 items-center">
            <a href="dashboard.php" class="text-slate-300 hover:text-white flex items-center gap-2 transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Back to Dashboard
            </a>

            <a href="register.php" class="bg-blue-600 px-4 py-2 rounded-lg font-bold hover:bg-blue-500 transition-all">
                + New Client
            </a>
        </div>
    </div>
   <style>
    body {
        /* Standard Money Background (from image_f9a89d.jpg) */
        background-color: #0f172a; 
        background-image: linear-gradient(rgba(15, 23, 42, 0.45), rgba(15, 23, 42, 0.5)), 
                          url('image1.jpg'); 
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        background-repeat: no-repeat;
        min-height: 100vh;
        color: white;
    }

    /* THE GLITTER EFFECT: Shiny Overlay */
    body::after {
        content: '';
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        
        /* This angular white line creates the "glare" look */
        background: linear-gradient(110deg, 
            rgba(215, 195, 195, 0) 40%, 
            rgba(234, 220, 220, 0.08) 50%, 
            rgba(229, 213, 213, 0) 60%
        );
        
        background-size: 200% auto;
        animation: glitterShine 5s infinite; /* Make it shine */
        pointer-events: none; /* User can still click through it */
        z-index: -1; /* Place it behind the text and cards */
    }

    /* Animation definition for the shine */
    @keyframes glitterShine {
        to {
            background-position: 200% center;
        }
    }

    /* Ensure your dashboard cards pop */
    .dashboard-card, .dashboard-container {
        background: rgba(30, 41, 59, 0.7); 
        backdrop-filter: blur(10px); /* Glass effect from image_ddde25.jpg */
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
    }
</style>
</nav>