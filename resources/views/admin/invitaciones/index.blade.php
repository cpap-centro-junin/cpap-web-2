@extends('layouts.admin')

{{-- admin-invitaciones.css eliminado - estilos en admin.css --}}

@section('title', 'Invitaciones')

@section('content')

<div class="admin-card">

    <!-- HEADER -->
    <div class="card-header">
        <div>
            <h1>Invitaciones</h1>
            <p>Gestiona las invitaciones para nuevos administradores.</p>
        </div>

        <button class="primary-btn" onclick="toggleForm()">
            + Nueva invitación
        </button>
    </div>


    <!-- ALERTA -->
    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif


    <!-- FORMULARIO -->
    <div id="inviteForm" class="invite-form">
        <form action="{{ route('admin.invitaciones.enviar') }}" method="POST">
            @csrf

            <div class="form-row">

                <input 
                    type="email" 
                    name="email"
                    placeholder="Correo del invitado"
                    required
                >

                <button class="primary-btn">
                    Enviar invitación
                </button>

            </div>
        </form>
    </div>


    <!-- BUSCADOR -->
    <div class="table-tools">
        <input 
            type="text"
            id="searchInput"
            placeholder="Buscar invitación..."
        >
    </div>


    <!-- TABLA PRO -->
    <div class="table-container">

        <table class="admin-table" id="inviteTable">
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Token</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                @foreach($invitaciones as $inv)
                <tr>

                    <td>{{ $inv->email }}</td>

                    <td>
                        <span class="token">
                            {{ Str::limit($inv->token, 12) }}
                        </span>
                    </td>

                    <td>
                        @if($inv->usado)
                            <span class="badge used">Usado</span>
                        @else
                            <span class="badge active">Pendiente</span>
                        @endif
                    </td>

                    <td>{{ $inv->created_at->format('d/m/Y') }}</td>

                    <td>
                        <button 
                            class="table-btn"
                            onclick="copyToken('{{ $inv->token }}')"
                        >
                            Copiar
                        </button>
                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>

    </div>

</div>



<script>

/* Toggle form */
function toggleForm(){
    document.getElementById("inviteForm")
        .classList.toggle("show");
}

/* Buscar */
document.getElementById("searchInput")
.addEventListener("keyup", function(){

    let value = this.value.toLowerCase();
    let rows = document.querySelectorAll("#inviteTable tbody tr");

    rows.forEach(row=>{
        row.style.display =
            row.innerText.toLowerCase().includes(value)
                ? ""
                : "none";
    });

});

/* Copiar token */
function copyToken(token){

    navigator.clipboard.writeText(token);

    alert("Token copiado ✔");

}

</script>

@endsection
