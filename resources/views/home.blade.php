@extends('layouts.main')

@push('css-custom')
<style>
    /* Tema Biru Muda - Konsisten dengan Login/Register */
    body {
        background: linear-gradient(135deg, #e0f2fe 0%, #bae6fd 100%) !important;
        min-height: 100vh;
    }

    .card {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 20px rgba(14, 165, 233, 0.1);
        border: none;
        overflow: hidden;
    }

    .card-header {
        background: linear-gradient(135deg, #38bdf8 0%, #0ea5e9 100%);
        color: white;
        font-weight: 700;
        padding: 20px 25px;
        border-bottom: none;
    }

    .card-body {
        padding: 25px;
        color: #0c4a6e;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        color: #065f46;
        border-left: 4px solid #10b981;
        border-radius: 10px;
        border: none;
    }

    /* Responsive untuk Mobile */
    @media (max-width: 768px) {
        .container {
            padding: 15px;
        }

        .card {
            margin: 0;
        }

        .card-header {
            padding: 15px;
            font-size: 16px;
        }

        .card-body {
            padding: 15px;
            font-size: 14px;
        }
    }
</style>
@endpush

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    @if(Auth::user()->role == 1)
                    selamat datang admin
                    @else (Auth::user()->role == 2)
                    selamat datang wali murid
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection