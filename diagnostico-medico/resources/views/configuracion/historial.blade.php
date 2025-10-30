<style>
    .subida-historial {
        background: linear-gradient(135deg, #e3f2fd, #fce4ec);
        border: 1px solid #dee2e6;
        border-radius: 12px;
        padding: 24px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        transition: all 0.3s ease-in-out;
    }

    .subida-historial:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.1);
    }

    .subida-historial h5 {
        font-weight: 600;
        color: #37474f;
    }

    .subida-historial .form-label {
        font-weight: 500;
        color: #263238;
    }

    .custom-file-button {
        position: relative;
        overflow: hidden;
        display: inline-block;
        border-radius: 8px;
        background: linear-gradient(to right, #ff6a00, #ee0979);
        color: white;
        padding: 10px 20px;
        font-weight: 500;
        cursor: pointer;
        transition: background 0.3s ease-in-out;
    }

    .custom-file-button:hover {
        background: linear-gradient(to right, #ee0979, #ff6a00);
    }

    .custom-file-button input[type="file"] {
        position: absolute;
        left: 0;
        top: 0;
        opacity: 0;
        cursor: pointer;
        height: 100%;
        width: 100%;
    }

    .subida-historial .btn-success {
        border-radius: 8px;
        padding: 8px 20px;
        font-weight: 500;
        background: linear-gradient(to right, #43cea2, #185a9d);
        border: none;
        color: white;
        transition: background 0.3s ease-in-out;
    }

    .subida-historial .btn-success:hover {
        background: linear-gradient(to right, #185a9d, #43cea2);
    }

    .alert-info {
        background: linear-gradient(135deg, #d0f0ff, #c8e6c9);
        color: #1b5e20;
        border-radius: 8px;
        padding: 16px;
        margin-top: 20px;
        border-left: 4px solid #66bb6a;
    }

    .btn-ver-archivo {
        font-weight: 500;
        border-radius: 8px;
        background: linear-gradient(to right, #1e88e5, #42a5f5);
        color: white;
        padding: 8px 16px;
        text-decoration: none;
        transition: background 0.3s ease-in-out;
        display: inline-block;
    }

    .btn-ver-archivo:hover {
        background: linear-gradient(to right, #42a5f5, #1e88e5);
        color: white;
    }
</style>

<div class="subida-historial mt-4">
    <h5 class="text-secondary mb-3">
        <i class="bi bi-cloud-upload-fill text-success me-2"></i> Subir historial clínico
    </h5>

    <form action="{{ route('historial.subir') }}" method="POST" enctype="multipart/form-data" class="needs-validation" novalidate>
        @csrf
        <div class="mb-3">
            <label class="form-label">Selecciona un archivo PDF, DOC o TXT</label><br>
            <label class="custom-file-button">
                <i class="bi bi-folder2-open me-1"></i> Seleccionar archivo
                <input type="file" name="historial" accept=".pdf,.doc,.docx,.txt" required>
            </label>
            <div class="form-text mt-2">Máximo 2MB. Se almacenará de forma segura.</div>
        </div>

        <button type="submit" class="btn btn-success mt-3">
            <i class="bi bi-upload me-1"></i> Subir historial
        </button>
    </form>

    @if(session('usuario_historial_archivo'))
        <div class="alert alert-info d-flex align-items-center justify-content-between">
            <div>
                <strong><i class="bi bi-file-earmark-check-fill me-2"></i> Archivo subido:</strong><br>
                <span class="text-muted">{{ basename(session('usuario_historial_archivo')) }}</span>
            </div>
            <a href="{{ asset('storage/' . session('usuario_historial_archivo')) }}" target="_blank" class="btn-ver-archivo">
                <i class="bi bi-eye-fill me-1"></i> Ver archivo
            </a>
        </div>
    @endif
</div>

