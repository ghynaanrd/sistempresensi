<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - PT Absen Terus</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1e3a5f;  /* Biru dongker */
            --primary-medium: #2c5282; /* Biru sedang */
            --primary-light: #4a7bbe;  /* Biru terang */
            --cream-bg: #f8f4e9;       /* Cream untuk background */
            --cream-card: #fffbf0;     /* Cream lebih terang untuk kartu */
            --accent-gold: #d4af37;    /* Emas untuk aksen */
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-medium) 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .login-container {
            animation: fadeIn 0.8s ease-in-out;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            backdrop-filter: blur(10px);
            background: var(--cream-card);
        }
        .card-header {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium)) !important;
            padding: 2.5rem 1rem;
            border-bottom: none;
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255,255,255,0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }
        .card-header h4 {
            font-weight: 700;
            letter-spacing: 1px;
            position: relative;
            z-index: 1;
        }
        .card-body {
            padding: 2.5rem;
        }
        .form-control {
            border-radius: 10px;
            padding: 0.75rem 1rem;
            border: 2px solid #e2e8f0;
            transition: all 0.3s ease;
            background: #f8fafc;
        }
        .form-control:focus {
            border-color: var(--primary-medium);
            box-shadow: 0 0 0 0.2rem rgba(44, 82, 130, 0.15);
            background: white;
            transform: translateY(-2px);
        }
        .input-group-text {
            background: var(--primary-medium);
            border: none;
            color: white;
            border-radius: 10px 0 0 10px;
        }
        .btn-login {
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
            border: none;
            border-radius: 10px;
            padding: 0.75rem;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(30, 58, 95, 0.3);
        }
        .btn-login:active {
            transform: translateY(0);
        }
        .btn-login::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            transition: left 0.5s;
        }
        .btn-login:hover::before {
            left: 100%;
        }
        .company-logo {
            width: 60px;
            height: 60px;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        .company-logo i {
            font-size: 1.5rem;
            background: linear-gradient(135deg, var(--primary-dark), var(--primary-medium));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .login-footer {
            text-align: center;
            margin-top: 1.5rem;
            color: #64748b;
            font-size: 0.9rem;
        }
        .password-toggle {
            background: transparent;
            border: none;
            color: #64748b;
            cursor: pointer;
            padding: 0.5rem;
            transition: color 0.3s ease;
            border-radius: 0 10px 10px 0;
        }
        .password-toggle:hover {
            color: var(--primary-medium);
            background: rgba(44, 82, 130, 0.1);
        }
        .password-input-group {
            position: relative;
        }
        .floating-icon {
            position: absolute;
            font-size: 0.8rem;
            color: var(--primary-medium);
            top: 50%;
            right: 50px;
            transform: translateY(-50%);
            pointer-events: none;
        }
        .form-label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
        }
        .alert {
            border-radius: 10px;
            border: none;
            animation: shake 0.5s ease-in-out;
            background: #fee2e2;
            color: #dc2626;
            border-left: 4px solid #dc2626;
        }
        .alert i {
            color: #dc2626;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes shine {
            0% { transform: rotate(45deg) translateX(-100%); }
            100% { transform: rotate(45deg) translateX(100%); }
        }
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5 col-lg-4">
                <div class="login-container">
                    <div class="card login-card">
                        <div class="card-header text-center text-white">
                            <div class="company-logo">
                                <i class="fas fa-fingerprint"></i>
                            </div>
                            <h4>PT ABSEN TERUS</h4>
                        </div>
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-exclamation-triangle me-2"></i>
                                        <div>
                                            <strong>Login Gagal!</strong>
                                            <ul class="mb-0 mt-1">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <form action="{{ route('login.post') }}" method="POST">
                                @csrf
                                <div class="mb-4">
                                    <label class="form-label">Email Address</label>
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control" required 
                                               placeholder="admin@absen.com" value="{{ old('email') }}">
                                    </div>
                                    <i class="floating-icon fas fa-at"></i>
                                </div>
                                
                                <div class="mb-4">
                                    <label class="form-label">Password</label>
                                    <div class="input-group password-input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <input type="password" name="password" id="password" class="form-control" required 
                                               placeholder="Masukkan password">
                                        <button type="button" class="password-toggle" id="togglePassword">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    </div>
                                    <i class="floating-icon fas fa-key"></i>
                                </div>
                                
                                <button type="submit" class="btn btn-login text-white w-100 py-2">
                                    <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                                </button>
                            </form>

                            <div class="login-footer">
                                <p class="mb-0">
                                    <i class="fas fa-shield-alt me-1"></i>
                                    Sistem Presensi Digital
                                </p>
                                <small>&copy; 2024 PT Absen Terus. All rights reserved.</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Toggle password visibility
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');

        togglePassword.addEventListener('click', function() {
            // Toggle the type attribute
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            // Toggle the eye icon
            const icon = this.querySelector('i');
            if (type === 'password') {
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        });

        // Tambahkan efek interaktif pada input
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animasi loading saat submit
        document.querySelector('form').addEventListener('submit', function() {
            const btn = this.querySelector('button[type="submit"]');
            btn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
            btn.disabled = true;
        });

        // Enter key untuk submit form
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                document.querySelector('form').dispatchEvent(new Event('submit'));
            }
        });
    </script>
</body>
</html>