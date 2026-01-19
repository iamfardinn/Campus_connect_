<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>

    body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
        height: 100vh;
    }

    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

 
    .glass-login {
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 24px;
        padding: 40px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
    }

    .form-control {
        background: rgba(255, 255, 255, 0.9);
        border: none;
        border-radius: 12px;
        padding: 12px 20px;
    }

    .login-btn {
        background: #ffffff;
        color: #4f46e5;
        border: none;
        font-weight: 700;
        border-radius: 12px;
        padding: 12px;
        transition: 0.3s;
    }

    .login-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.2);
        background: #f8f9fa;
    }
</style>

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5">
        <div class="glass-login text-white text-center">
            <h2 class="fw-bold mb-4">Welcome Back!</h2>
            <p class="mb-5 opacity-75">Login to access your Campus Connect dashboard</p>
            
            <form action="<?php echo URLROOT; ?>/auth/login" method="post">
                <div class="mb-4 text-start">
                    <label class="form-label small fw-bold">Email Address</label>
                    <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
                </div>
                
                <div class="mb-4 text-start">
                    <label class="form-label small fw-bold">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                </div>
                
                <button type="submit" class="login-btn w-100 mb-4">
                    Sign In <i class="bi bi-arrow-right-short"></i>
                </button>
                
                <p class="small mb-0">Don't have an account? 
                    <a href="<?php echo URLROOT; ?>/auth/register" class="text-white fw-bold">Register here</a>
                </p>
            </form>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>