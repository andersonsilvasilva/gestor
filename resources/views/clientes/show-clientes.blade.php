<x-layout-app page-title="Detalhes da Ficha de Cliente">

    <div class="border-light shadow w-100 p-4">
        <div class="container-fluid">
            <div class="row mb-1">

                <div class="col border border-light p-2">
                    <h5>Visualizar os dados do Cliente:</h5>
                    <hr>
                    <p>C.N.S.: <strong>{{$clientes->cns}}</strong></p>
                    <p>Nome do Cliente: <strong>{{$clientes->nome}}</strong></p>
                    <p>Email: <strong>{{$clientes->email}}</strong></p>
                    <p>Telefone: <strong>{{$clientes->telefone}}</strong></p> 
                    <p>Data de Nascimento: <strong>{{ \Carbon\Carbon::parse($clientes->data_nascimento)->format('d/m/Y')}}</strong></p>
                    <p>Logradouro: <strong>{{$clientes->logradouro}}</strong></p>
                    <p>Endereço: <strong>{{$clientes->endereco}}</strong>    Nº:<strong>{{$clientes->numero}}</strong></p>
                    <p>Complemento: <strong>{{$clientes->complemento}}</strong></p>
                    <p>Bairro: <strong>{{$clientes->bairro}}</strong></p>
                    <p>Cidade: <strong>{{$clientes->cidade}}</strong> -  Estado: <strong>{{$clientes->uf}}</strong> </p>
                    <p>Cep: <strong>{{$clientes->cep}}</strong>  </p>
                </div>
                <div class="col border border-light p-2">
                    <h5>Outras Informações:</h5>
                    <hr>
                    <p>Atividade Laboral: <strong>{{$clientes->ativ_laboral}}</strong></p>
                    <p>Tipo Sanguineo: <strong>{{$clientes->tipo_sangue}}</strong></p>
                    <p>Cor: <strong>{{$clientes->cor}}</strong><p>
                    <p>Etnia: <strong>{{$clientes->etnia}}</strong></p>
                    <hr>
                    <h6>Última Consulta: <strong>{{ \Carbon\Carbon::parse($clientes->update_id)->format('d/m/Y')}}</strong></h6>
                    <hr>
                    <p>Observações: <strong>{{$clientes->observacao}}</strong></p>

                    <p>Status de Atividade: 
                        @if(in_array($clientes->ativo, [0]))
                            <span class="badge bg-danger">Não</span>
                        @else
                            <span class="badge bg-success">Sim</span>
                        @endif
                    </p>
                </div>
            </div>
        </div>
        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fas fa-arrow-left me-1"></i>Voltar</button>

    </div>

</x-layout-app>