<?php require APPROOT . '/views/layouts/header.php'; ?>

<style>
    /* Animated Floating Shape Background */
    body {
        background: #0f172a; /* Deep Dark Modern Theme */
        overflow-x: hidden;
        color: white;
    }

    .hero-section {
        padding: 100px 0;
        position: relative;
    }

    .hero-title {
        font-size: 4rem;
        font-weight: 800;
        background: linear-gradient(to right, #818cf8, #c084fc, #fb7185);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        line-height: 1.2;
    }

    /* Glassmorphism Feature Cards */
    .feature-card {
        background: rgba(255, 255, 255, 0.03);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 24px;
        padding: 30px;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .feature-card:hover {
        background: rgba(255, 255, 255, 0.07);
        transform: translateY(-15px) scale(1.02);
        border-color: #818cf8;
    }

    .icon-box {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
        font-size: 1.5rem;
    }

    .btn-get-started {
        background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
        border: none;
        padding: 15px 40px;
        border-radius: 50px;
        font-weight: 700;
        color: white;
        transition: 0.3s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-get-started:hover {
        box-shadow: 0 0 30px rgba(79, 70, 229, 0.6);
        transform: scale(1.05);
        color: white;
    }

    /* Floating Animation */
    @keyframes float {
        0% { transform: translateY(0px); }
        50% { transform: translateY(-20px); }
        100% { transform: translateY(0px); }
    }
    .floating-img { animation: float 6s ease-in-out infinite; }
</style>

<div class="hero-section text-center">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-lg-start">
                <h1 class="hero-title mb-4">Connecting Your Campus Resources.</h1>
                <p class="lead opacity-75 mb-5 fs-4">Experience the next generation of campus management. Book labs, classrooms, and resources with seamless AI-driven endorsements.</p>
                <div class="d-flex gap-3 justify-content-center justify-content-lg-start">
                    <a href="<?php echo URLROOT; ?>/auth/login" class="btn btn-get-started shadow-lg">Get Started Now</a>
                    <a href="#features" class="btn btn-outline-light rounded-pill px-4 py-3 border-2 fw-bold">Learn More</a>
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-block">
                <div class="floating-img text-primary" style="font-size: 15rem;">
                    <i class="bi bi-cpu-fill"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="features" class="container py-5">
    <div class="row g-4">
        <div class="col-md-4">
            <div class="feature-card text-center text-md-start h-100">
                <div class="icon-box mx-auto mx-md-0"><i class="bi bi-shield-check"></i></div>
                <h4 class="fw-bold mb-3">Smart Endorsement</h4>
                <p class="opacity-50 small">Automated faculty approval workflow designed for efficiency and speed.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center text-md-start h-100">
                <div class="icon-box mx-auto mx-md-0"><i class="bi bi-lightning-charge"></i></div>
                <h4 class="fw-bold mb-3">Instant Booking</h4>
                <p class="opacity-50 small">Real-time availability check for labs, halls, and academic resources.</p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="feature-card text-center text-md-start h-100">
                <div class="icon-box mx-auto mx-md-0"><i class="bi bi-grid-1x2"></i></div>
                <h4 class="fw-bold mb-3">Unified Control</h4>
                <p class="opacity-50 small">Centralized admin dashboard to manage the entire campus inventory.</p>
            </div>
        </div>
    </div>
</div>

<?php require APPROOT . '/views/layouts/footer.php'; ?>