<!-- resources/views/components/configuracion-panel.blade.php -->
<div class="config-panel">
    <h3>⚙️ Configuración</h3>

    <section>
        <h4>🧑‍⚕️ Paciente</h4>
        <p>Nombre: {{ $paciente->nombre }}</p>
        <p>DNI: {{ $paciente->dni }}</p>
        <p>Edad: {{ $paciente->edad }}</p>
    </section>

    <section>
        <h4>🩺 Síntomas</h4>
        <a href="{{ route('sintomas.editar') }}">Editar lista de síntomas</a>
        <label><input type="checkbox" checked> Mostrar categorías</label>
    </section>

    <section>
        <h4>🧠 Diagnóstico</h4>
        <label><input type="radio" name="modo" value="tradicional"> Tradicional</label>
        <label><input type="radio" name="modo" value="ia" checked> IA</label>
        <label><input type="checkbox"> Mostrar explicación IA</label>
    </section>

    <section>
        <h4>🎨 Visual</h4>
        <select name="tema">
            <option value="institucional">Institucional</option>
            <option value="oscuro">Oscuro</option>
            <option value="magico">Mágico</option>
        </select>
    </section>

    <section>
        <h4>🔐 Seguridad</h4>
        <p>Rol actual: {{ Auth::user()->rol }}</p>
        <a href="{{ route('usuarios.configurar') }}">Configurar accesos</a>
    </section>
</div>
