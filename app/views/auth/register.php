<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
  
    body {
        background: linear-gradient(-45deg, #0f172a, #1e1b4b, #312e81, #1e1b4b);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
        color: white;
    }

    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

   
    .glass-register {
        background: rgba(255, 255, 255, 0.05);
        backdrop-filter: blur(25px);
        -webkit-backdrop-filter: blur(25px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 30px;
        padding: 50px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }


    .form-control, .form-select {
        background: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.1) !important;
        border-radius: 15px !important;
        padding: 14px 20px !important;
        color: white !important;
        transition: all 0.3s ease;
    }

    .form-control:focus, .form-select:focus {
        background: rgba(255, 255, 255, 0.15) !important;
        border-color: #818cf8 !important;
        box-shadow: 0 0 15px rgba(129, 140, 248, 0.3) !important;
        outline: none;
    }

    .form-control::placeholder {
        color: rgba(255, 255, 255, 0.4);
    }

    .form-select option {
        background: #1e1b4b;
        color: white;
    }

    .register-btn {
        background: linear-gradient(135deg, #6366f1 0%, #a855f7 100%);
        color: white;
        border: none;
        font-weight: 700;
        border-radius: 15px;
        padding: 16px;
        letter-spacing: 1px;
        transition: all 0.4s ease;
        text-transform: uppercase;
    }

    .register-btn:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(99, 102, 241, 0.4);
        filter: brightness(1.1);
    }

    label { 
        font-weight: 500; 
        margin-bottom: 10px; 
        font-size: 0.85rem; 
        text-transform: uppercase;
        letter-spacing: 1px;
        color: rgba(255, 255, 255, 0.8);
    }

 
    .floating-icon {
        font-size: 3rem;
        background: linear-gradient(to bottom, #fff, #818cf8);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
</style>

<div class="container my-5 py-5">
    <div class="row justify-content-center align-items-center">
        <div class="col-lg-7 col-xl-6">
            <div class="glass-register text-center">
                <div class="mb-4">
                    <i class="bi bi-person-plus-fill floating-icon"></i>
                    <h1 class="fw-bold mt-3">Create Account</h1>
                    <p class="opacity-50">Secure your spot in the Campus Connect hub</p>
                </div>

                <form action="<?php echo URLROOT; ?>/auth/register" method="post">
                    <div class="row g-4 text-start">
                        <div class="col-12">
                            <label>Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
                        </div>

                        <div class="col-md-6">
                            <label>Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="name@campus.edu" required>
                        </div>

                        <div class="col-md-6">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <div class="col-md-6">
                            <label>User Role</label>
                            <select name="role" class="form-select" required>
                                <option value="Student">Student</option>
                                <option value="Faculty">Faculty</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label>ID Identification</label>
                            <input type="text" name="student_id" class="form-control" placeholder="ID Number (e.g. 22-XXXXX-1)" required>
                        </div>
                    </div>

                    <button type="submit" class="register-btn w-100 mt-5">
                        Create My Account <i class="bi bi-arrow-right-circle ms-2"></i>
                    </button>

                    <div class="mt-4">
                        <span class="opacity-50 small">Already a member?</span> 
                        <a href="<?php echo URLROOT; ?>/auth/login" class="text-white fw-bold text-decoration-none ms-1" style="border-bottom: 2px solid #818cf8;">Login Here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>