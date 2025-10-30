<style>
    .idioma-card {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: box-shadow 0.3s ease-in-out;
    }

    .idioma-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .idioma-card h3 {
        font-weight: 600;
        color: #37474f;
    }

    .idioma-card .form-label {
        font-weight: 500;
        color: #263238;
    }

    .idioma-card .form-select {
        border-radius: 8px;
        border: 1px solid #b0bec5;
        box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.05);
        transition: border-color 0.3s ease-in-out;
    }

    .idioma-card .form-select:focus {
        border-color: #42a5f5;
        box-shadow: 0 0 0 0.2rem rgba(66, 165, 245, 0.25);
    }

    .idioma-card .btn-primary {
        border-radius: 8px;
        padding: 10px 24px;
        font-weight: 500;
        background: linear-gradient(to right, #42a5f5, #1e88e5);
        border: none;
        color: white;
        transition: background 0.3s ease-in-out;
    }

    .idioma-card .btn-primary:hover {
        background: linear-gradient(to right, #1e88e5, #42a5f5);
    }

    .alert-success {
        border-left: 4px solid #66bb6a;
        background: linear-gradient(135deg, #d0f0ff, #c8e6c9);
        color: #1b5e20;
        border-radius: 8px;
        padding: 16px;
        margin-top: 20px;
    }
</style>

<div class="idioma-card mt-4">
    <h3 class="text-primary"> @lang('messages.select_language')</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/configuracion/idioma') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="idioma" class="form-label">@lang('messages.select_language')</label>
            <select name="idioma" id="idioma" class="form-select" required>
                <option value="es" {{ session('usuario_idioma') === 'es' ? 'selected' : '' }}>Español</option>
                <option value="en" {{ session('usuario_idioma') === 'en' ? 'selected' : '' }}>English</option>
                <option value="pt" {{ session('usuario_idioma') === 'pt' ? 'selected' : '' }}>Português</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="bi bi-globe me-1"></i> @lang('messages.save_language')
        </button>
    </form>
</div>
