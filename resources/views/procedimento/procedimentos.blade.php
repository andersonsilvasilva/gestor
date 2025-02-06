<x-layout-app page-title="Procedimentos">
    <div class="border-black shadow w-100 p-4">

        <h3>Procedimentos</h3>

        <hr>
        @if($procedimentos->count() ===0)
            <div class="text-center my-5">
                <p>Nenhum procedimento encontrado.</p>
                <a href="{{route('procedimentos.new-procedimento')}}" class="btn btn-danger">Criar um novo procedimento</a>
            </div>
         
        @else
            <div class="mb-3">
                <a href="{{route('procedimentos.new-procedimento')}}" class="btn btn-danger">Criar um novo procedimento</a>
            </div>

            <table class="table table-striped table-success" id="table">
                <thead class="table-dark">
                    <th>Codigo</th>
                    <th>Procedimentos</th>
                    <th>Status</th>
                    <th></th>
                </thead>
                <tbody>
                    @foreach ($procedimentos as $procedimento)
                        <tr>    
                            <td>{{ $procedimento->codigo}}</td>
                            <td>{{ $procedimento->name}}</td>
                            <td>
                                @if(in_array($procedimento->ativo, [0]))
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex gap-3 justify-content-end">
                                    @if(in_array($procedimento->id, [1]))
                                        <i class="fa-solid fa-lock"></i>
                                    @else
                                    <a href="{{ route('procedimentos.edit-procedimento',['id'=>$procedimento->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-pen-to-square me-2"></i>Editar</a>
                                    <a href="{{ route('procedimentos.delete-Procedimento',['id'=>$procedimento->id]) }}" class="btn btn-sm btn-outline-dark"><i class="fa-regular fa-trash-can me-2"></i>Deletar</a>
                                @endif
                            </td>
                        </tr>                      
                    @endforeach
                </tbody>
            </table>
            {{ $procedimentos->links() }}
            
        @endif



    </div>
</x-layout-app>