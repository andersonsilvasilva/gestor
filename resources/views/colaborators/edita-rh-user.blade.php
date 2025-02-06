<x-layout-app page-title="Alterar dados do colaborador">

    <div class="w-100 p-4">

        <h3>Alterar Dados do Colaborador</h3>

        <hr>

        <form action="{{ route('colaborators.rh.update-colaborator') }}" method="post">

            @csrf

            <div class="d-flex gap-5">
                <p> Nome do Colaborador: <strong>{{$colaborator->name}}</strong></p>
                <p> Email do Colaborador: <strong> {{$colaborator->email}} </strong></p>
            </div>

            <hr>
            <input type="hidden"  name="id" value="{{ $colaborator->id }}"> 

            <div class="container-fluid align-left">

                <div class="row gap-3">

                {{-- user details --}}
                    <div class="col border border-black p-4">
                         <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="telefone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="telefone" name="telefone" value="{{ old('telefone', $colaborator->detail->telefone) }}">
                                    @error('telefone')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salario" class="form-label">Salario</label>
                                    <input type="number" class="form-control" id="salario" name="salario" step=".01" placeholder="0,00" value="{{ old('salario', $colaborator->detail->salario) }}">
                                    @error('salario')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                    <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="YYYY-mm-dd" value="{{ old('data_nascimento', $colaborator->detail->data_nascimento) }}">
                                    @error('data_nascimento')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cns" class="form-label">Cartão do SUS</label>
                                    <input type="text" class="form-control" id="cns" name="cns" placeholder="000.0000.0000.0000" value="{{ old('cns', $colaborator->detail->cns) }}">
                                    @error('cns')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cbo" class="form-label">C.B.O</label>
                                    <input type="text" class="form-control" id="cbo" name="cbo" placeholder="000000" value="{{ old('cbo', $colaborator->detail->cbo) }}">
                                    @error('cbo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Data Admissão Date</label>
                                    <input type="date" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date', $colaborator->detail->admission_date) }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    <a href="{{ route('colaborators.rh-users') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Alterar colaborador</button>
                </div>

            </div>

        </form>

    </div>

</x-layout-app>
