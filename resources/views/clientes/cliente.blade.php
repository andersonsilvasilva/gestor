<x-layout-app page-title="Clientes">

    <div class="border-light shadow w-100 p-4 ">

        <h3>Clientes</h3>
        <hr>

        @if($clientes->count() ===0)
            <div class="card p-2 mb-2 border-light shadow">
                <div class="card d-flex justify-content-center">
                    <p>Nenhum cliente cadastrado</p>
                </div>
                <div class="card d-flex justify-content-center">
                    <a href="{{route('clientes.new-cliente')}}" class="btn btn-danger btn-md mb-2">Criar um novo cliente</a>
                </div>
            </div>
            @else
            <div class="card-header p-2 mb-2 me-lg-1 border-light shadow">
                <form action="{{ route('clientes')}}">
                    <div class="justify-content-left">
                        <div class="input-group">
                            <div class="col mt-0 mb-2 me-lg-2">
                                {{--<label class="form-label" for="nome"></label>--}}
                                <input type="text" name="nome" id="nome"
                                    class="form-control form-control-white text-bg-info" value="{{ $nome }}"
                                    placeholder="Pesquisar o nome do cliente"/>
                            </div>
                            <div class="col mt-0 mb-3 me-lg-2">
                                    <button type="submit" class="btn btn-info btn-md input-group-btn">Pequisar</button>
        
                                    <a href="{{ route('clientes')}}" class="btn btn-warning btn-md input-group-btn">Limpar</a>
                                    <a href="{{ route('clientes.new-cliente')}}"
                                        class="btn btn-danger btn-md input-group-btn">Criar um novo cliente</a>
                                    <a href="{{ route('home') }}" class="btn btn-success">Home</a> 
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-body">
                <table class="table table-striped table-success" id="table">
                    <thead class="table-dark text-left">
                        <th>Cartão SUS</th>
                        <th>Nome do cliente</th>
                        <th>Idade</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th class="text-center">Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td>{{$cliente->cns}}</td>
                            <td>{{$cliente->nome}}</td>
                            <td>{{ \Carbon\Carbon::parse($cliente->data_nascimento)->age}}</td>
                            <td>{{$cliente->telefone}}</td>  
                            <td>
                                @if(in_array($cliente->ativo, [0]))
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endif
                            </td>
                            <td class="d-md-flex justify-content-center">
                                <div class="d-flex gap-3 justify-content-end">
                                    @if(empty(!$cliente->deleted_at))
                                        <a href="{{ route('cliente.restore-cliente', ['id' => Crypt::encrypt($cliente->id)])}}"
                                            class="btn btn-sm btn-outline-dark"><i
                                            class="fa-solid fa-trash-arrow-up me-1"></i>Restaurar</a>
                                    @else
                                        <a href="{{ route('agenda.index',           ['id' => Crypt::encrypt($cliente->id)]) }}" 
                                                class="btn btn-sm btn-success"><i 
                                                class="fa fa-user-md me-2"></i>Atender</a>

                                        <a href="{{ route('atendimento.listar',     ['id' => Crypt::encrypt($cliente->id)]) }}" 
                                                class="btn btn-sm btn-primary"><i 
                                                class="fa fa-history me-2"></i>History</a>
                                        
                                        <a href="{{ route('cliente.details',        ['id' => Crypt::encrypt($cliente->id)]) }}"
                                                class="btn btn-sm btn-info"><i 
                                                class="fa-regular fa-eye me-1"></i>Detalhes</a>  

                                        <a href="{{ route('cliente.edita-cliente',  ['id' => Crypt::encrypt($cliente->id)]) }}"
                                                class="btn btn-sm btn-warning"><i 
                                                class="fa-regular fa-pen-to-square me-1"></i>Editar</a>

                                        <a href="{{ route('cliente.delete-cliente', ['id' => Crypt::encrypt($cliente->id)]) }}"
                                                class="btn btn-sm btn-danger"><i 
                                                class="fa-regular fa-trash-can me-1"></i>Apagar</a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>  
                {{ $clientes->links() }}              
            </div>           
          </div>
        @endif
    
</x-layout-app>