<x-layout-app page-title="Listar Atendimentos do Cliente">
    <div class="border-light shadow w-100 p-4 ">
        <h3 class="justify-content-center" >Atendimentos ao cliente</h3>
        <hr>
        @if($eventos->count() ===0)
            <div class="card p-2 mb-2 mt-2 border-light shadow">
                <div class="flex-nowrap mb-0 mt-2 p-2">
                    <div class="float-start justify-content-center">
                        <h4>
                            <p>Nenhum atendimento realizado para o cliente!</p>
                        </h4>   
                    </div>
                    <div class="float-end">
                        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa fa-arrow-left  me-2"></i>Voltar</button>
                    </div>
                </div>    
            </div>
        @else
            <div class="card-header p-2 mb-2 me-lg-1 p-4 border-light shadow">
                <div class="flex-nowrap mb-4 p-2">
                    <div class="float-start">
                        <h3>
                            <i class="fa-solid fa-user me-3"></i>{{$clientes->nome}} 
                        </h3>   
                    </div>
                    <div class="float-end">
                        <button class="btn btn-outline-dark" onclick="window.history.back()"><i class="fa fa-arrow-left  me-2"></i>Voltar</button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-striped table-success" id="table">
                    <thead class="table-dark text-left">
                        <th>ID</th>
                        <th>Data Atendimento</th>
                        <th>Nome do Terapeuta</th>
                        <th>Procedimento</th>
                        <th>Atendido</th>
                        <th class="text-center">Ações</th>
                    </thead>
                    <tbody>
                        @foreach ($eventos as $eventoModel)
                          <tr>    
                            <td>{{$eventoModel->ordem}}</td></td>                        
                            <td>{{\Carbon\Carbon::parse($eventoModel->start)->format('d/m/Y H:i')}}</td>
                            <td>{{$eventoModel->terapeuta}}</td>
                            <td>{{mb_strtoupper($eventoModel->procedimento,"utf-8" )}}</td>  
                            <td>
                                @if(in_array($eventoModel->status, [0]))
                                    <span class="badge bg-danger">Não</span>
                                @else
                                    <span class="badge bg-success">Sim</span>
                                @endif
                            </td>
                            <td class="d-md-flex justify-content-center">
                                <div class="d-flex gap-3 justify-content-end">
                                    @if($eventoModel->userid == auth()->user()->id)
                                        <div x-data="{}" class="mb=2">
                                          <button class="btn btn-danger"   @click="$dispatch('open-evento-modal',{{json_encode($eventoModel)}})">Atendido por você</button>
                                        </div>
                                    @else 
                                        <div x-data="{}" class="mb=2">
                                          <button class="btn btn-primary"  @click="$dispatch('open-evento-modale',{{json_encode($eventoModel)}})">Atendido por outro</button>
                                        </div>

                                    @endif
                                </div>
                            </td>
                           </tr>

                        @endforeach
                    </tbody>
                </table>  
                {{ $eventos->links() }}              
                
            </div>           
          </div>
        @endif         
    </div>
</x-layout-app>