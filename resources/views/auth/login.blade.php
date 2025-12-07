@extends('layouts.auth')
@section('content')
<style>
    body {
        background: linear-gradient(135deg, #7dd3fc 0%, #0ea5e9 100%) !important;
        min-height: 100vh !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    .login-container {
        display: flex;
        max-width: 1200px;
        width: 90%;
        background: rgba(255, 255, 255, 0.95);
        border-radius: 30px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        animation: fadeInQuick 0.6s ease-out;
    }

    @keyframes fadeInQuick {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .login-left {
        flex: 1;
        background: linear-gradient(135deg, #bae6fd 0%, #7dd3fc 100%);
        padding: 60px 40px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
    }

    .login-left::before {
        content: '';
        position: absolute;
        top: -50px;
        left: -50px;
        width: 200px;
        height: 200px;
        background: rgba(14, 165, 233, 0.2);
        border-radius: 50%;
    }

    .login-left::after {
        content: '';
        position: absolute;
        bottom: -30px;
        right: -30px;
        width: 150px;
        height: 150px;
        background: rgba(14, 165, 233, 0.15);
        border-radius: 50%;
    }

    .illustration-circle {
        width: 350px;
        height: 350px;
        background: rgba(14, 165, 233, 0.2);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 30px;
        position: relative;
        z-index: 1;
    }

    .illustration-placeholder {
        width: 300px;
        height: 300px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 80px;
        color: #0284c7;
        overflow: hidden;
    }

    .illustration-placeholder img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 20px;
    }

    .tagline {
        text-align: center;
        color: #0c4a6e;
        margin-top: 20px;
        position: relative;
        z-index: 1;
    }

    .tagline h3 {
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 10px;
        color: #075985;
    }

    .tagline p {
        font-size: 14px;
        color: #0c4a6e;
        opacity: 0.9;
    }

    .login-right {
        flex: 1;
        padding: 60px 50px;
        background: white;
    }

    .login-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .logo-container {
        width: 150px;
        height: 150px;
        margin: 0 auto 20px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        color: white;
        overflow: hidden;
        padding: 3px;
    }

    .logo-container img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        border-radius: 10px;
    }

    .login-header h2 {
        font-size: 28px;
        color: #075985;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .login-header p {
        color: #0c4a6e;
        font-size: 14px;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        color: #075985;
        font-size: 14px;
        font-weight: 500;
    }

    .form-control {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 15px;
        transition: all 0.3s ease;
        background: #f7fafc;
    }

    .form-control:focus {
        outline: none;
        border-color: #0ea5e9;
        background: white;
        box-shadow: 0 0 0 3px rgba(14, 165, 233, 0.1);
    }

    .text-danger {
        color: #e53e3e;
        font-size: 13px;
        margin-top: 6px;
        display: block;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 25px;
    }

    .checkbox-inline {
        display: flex;
        align-items: center;
        color: #075985;
        font-size: 14px;
    }

    .checkbox-inline input[type="checkbox"] {
        margin-right: 8px;
        width: 18px;
        height: 18px;
        cursor: pointer;
    }

    .btn-login {
        width: 100%;
        padding: 15px;
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 16px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(14, 165, 233, 0.3);
    }

    .btn-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(14, 165, 233, 0.4);
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
    }

    .btn-login:active {
        transform: translateY(0);
    }

    .divider {
        text-align: center;
        margin: 25px 0;
        position: relative;
    }

    .divider::before {
        content: '';
        position: absolute;
        left: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background: #e2e8f0;
    }

    .divider span {
        background: white;
        padding: 0 15px;
        position: relative;
        color: #a0aec0;
        font-size: 13px;
    }

    .social-login {
        display: flex;
        gap: 15px;
        margin-bottom: 25px;
    }

    .social-btn {
        flex: 1;
        padding: 12px;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        background: white;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font-size: 14px;
        color: #4a5568;
    }

    .social-btn:hover {
        border-color: #cbd5e0;
        background: #f7fafc;
    }

    .register-link {
        text-align: center;
        font-size: 14px;
        color: #718096;
        margin: 15px;
    }

    .register-link a {
        color: #0ea5e9;
        text-decoration: none;
        font-weight: 600;
        margin: 0 5px;
    }

    .register-link a:hover {
        text-decoration: underline;
    }

    @media (max-width: 968px) {
        .login-container {
            flex-direction: column;
            width: 95%;
            margin: 20px;
        }

        .login-left {
            padding: 40px 30px;
        }

        .illustration-circle {
            width: 250px;
            height: 250px;
        }

        .illustration-placeholder {
            width: 150px;
            height: 150px;
            font-size: 60px;
        }

        .login-right {
            padding: 40px 30px;
        }
    }

    @media (max-width: 576px) {
        .login-container {
            width: 100%;
            margin: 10px;
            border-radius: 20px;
        }

        .login-left {
            padding: 30px 20px;
        }

        .illustration-circle {
            width: 200px;
            height: 200px;
        }

        .illustration-placeholder {
            width: 120px;
            height: 120px;
            font-size: 50px;
        }

        .tagline h3 {
            font-size: 20px;
        }

        .tagline p {
            font-size: 12px;
        }

        .login-right {
            padding: 30px 20px;
        }

        .logo-container {
            width: 100px;
            height: 100px;
        }

        .login-header h2 {
            font-size: 22px;
        }

        .login-header p {
            font-size: 13px;
        }

        .form-control {
            padding: 12px 15px;
            font-size: 14px;
        }

        .btn-login {
            padding: 12px 20px;
            font-size: 14px;
        }
    }
</style>

<div class="login-container">
    <div class="login-left">
        <div class="illustration-circle">
            <div class="illustration-placeholder">
                <img src="{{ asset('images/3.png') }}" alt="TKIT Insan Kamil">
            </div>
        </div>
        <div class="tagline">
            <h3>TKIT Insan Kamil</h3>
            <p>Wujudkan Generasi Qur'ani, Cerdas, dan Berakhlak</p>
        </div>
    </div>

    <div class="login-right">
        <div class="login-header">
            <div class="logo-container">
                <img src="{{ asset('images/2.png') }}" alt="Logo">
            </div>
            <h2>Selamat Datang Kembali</h2>
            <p>Pembayaran Infaq Bulanan</p>
        </div>

        <form id="form-login" action="{{ route('login') }}" method="post">
            @csrf

            <div class="form-group">
                <label for="username">Username</label>
                <input
                    type="text"
                    id="username"
                    name="username"
                    class="form-control"
                    placeholder="Your username.."
                    value="{{ old('username') }}"
                    required
                    autofocus>
                @error('username')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control"
                    placeholder="Your password.."
                    required>
                @error('password')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="remember-forgot">
                <div class="checkbox-inline">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                </div>
                @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" style="color: #0ea5e9; text-decoration: none; font-size: 14px;">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="btn-login">
                Login
            </button>

            @if (Route::has('register'))
            <div class="register-link">
                Don't have an account?
                <a href="{{ route('register') }}">Create an account</a>
            </div>
            @endif
        </form>
    </div>
</div>
@endsection