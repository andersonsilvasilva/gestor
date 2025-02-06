<x-layout-app page-title='Deletar o Colaborador'>
    <div class="w-25 p-4">

        <h3>Deletar o Colaborador</h3>
        <hr>
        <p>Você tem certeza que deseja apagar este colaborador?</p>
        <div class="text-center">
            <h5 class="my-5">{{ $colaborator->name }}</h5>
            <a href="{{ route('colaborators.rh-users') }}" class="btn btn-secondary px-5">Não</a>
            <a href="{{ route('colaborators.rh.delete-confirm', ['id' => $colaborator->id]) }}" class="btn btn-danger px-5">Sim</a>
        </div>
    </div>
</x-layout-app>