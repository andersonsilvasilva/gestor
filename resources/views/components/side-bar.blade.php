<div class="d-flex flex-column sidebar pt-2">
        <a href="{{ route('home')}}"><i class="fas fa-home me-2"></i>Home</a>
        <a href="{{ route('clientes')}}"><i class="fas fa-solid fa-id-card me-2"></i>Clientes</a>
        @can('admin')
            <a href="{{ route('departments')}}"><i class="fas fa-industry me-2"></i>Departamentos</a>
            <a href="{{ route('procedimentos')}}"><i class="fas fa-solid fa-mortar-pestle me-2"></i>Procedimentos</a>
            <a href="{{ route('colaborators.rh-users')}}"><i class="fas fa-user-gear me-2"></i>Colaboradores</a>
        @endcan
            <a href="{{ route('gerador')}}"><i class="fa-regular fa-newspaper me-2"></i>Relatórios</a>                                 
    <hr>
    <a href="{{route('user.profile')}}"><i class="fas fa-cog me-2"></i>Perfil Usuário</a>
    <hr>
    {{--logout --}}
        <div class="text-center mt-3">
            <form action="{{route('logout')}}" method="post">
                @csrf
                <button type='submit' class="btn btn-sm btn-outline-dark">
                    <i class="fas fa-sign-out-alt me-2"></i>Sair
                </button>
            </form>
        </div>
</div>

