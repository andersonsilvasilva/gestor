<x-layout-app page-title="Novo Colaborador">

    <div class="w-100 p-4">

        <h3>Novo Colaborador</h3>

        <hr>

        <form action="{{ route('colaborators.rh.create-colaborator') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row gap-3">

                    {{-- user --}}
                    <div class="col border border-black p-4">

                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input type="text" class="form-control" id="name" oninput="this.value = this.value.toUpperCase()" name="name" value="{{ old('name') }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex">
                                <div class="flex-grow-1 pe-3">
                                    <label for="select_department">Departamentos</label>
                                    <select class="form-select" id="select_department" name="select_department">
                                        @foreach ($departments as $department)
                                            @if($department->id==2||3))
                                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('select_department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div>
                                    <a href="{{ route('departments.new-department') }}"
                                        class="btn btn-outline-primary mt-4"><i class="fas fa-plus"></i></a>
                                </div>
                            </div>
                            <hr>
                            <p class="mb-3">Profile: <strong>Recursos Humanos</strong></p>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="telefone" class="form-label">Telefone</label>
                                        <input type="text" class="form-control" id="telefone" name="telefone" data-mask="(00)00000-0000" value="{{ old('telefone') }}">
                                        @error('telefone')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                        <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" placeholder="YYYY-mm-dd" value="{{ old('data_nascimento') }}">
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
                                    <input type="text" class="form-control" id="cns" name="cns" size=18 data-mask="000.0000.0000.0000" value="{{ old('cns') }}">
                                    @error('cns')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cbo" class="form-label">Número do CBO</label>
                                    <input type="text" class="form-control" id="cbo" name="cbo" placeholder="0000000" value="{{ old('cbo') }}">
                                    @error('cbo')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    {{-- user details --}}
                    <div class="col border border-black p-4">

                        <div class="mb-3">
                            <label for="endereco" class="form-label">Endereço</label>
                            <input type="text" class="form-control" id="endereco" name="endereco" value="{{ old('endereco') }}">
                            @error('endereco')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bairro" class="form-label">Bairro</label>
                            <input type="text" class="form-control" id="bairro" name="bairro" value="{{ old('bairro') }}">
                            @error('bairro')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cep" class="form-label">Cep</label>
                                    <input type="text" class="form-control" id="cep" name="cep" data-mask="00000-000"value="{{ old('cep') }}">
                                    @error('cep')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="cidade" class="form-label">Cidade</label>
                                    <input type="text" class="form-control" id="cidade" name="cidade" value="{{ old('cidade') }}">
                                    @error('cidade')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="salario" class="form-label">Salário</label>
                                    <input type="number" class="form-control" id="salario" name="salario" step=".01" placeholder="0,00" value="{{ old('salario') }}">
                                    @error('salario')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="admission_date" class="form-label">Admission Date</label>
                                    <input type="date" class="form-control" id="admission_date" name="admission_date" placeholder="YYYY-mm-dd" value="{{ old('admission_date') }}">
                                    @error('admission_date')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="mb-3">
                                    <label for="comentario" class="form-label">Observações</label>
                                    <input type="text" class="form-control" id="comentario" name="comentario" value="{{ old('comentario') }}">
                                    @error('comentario')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <div class="mt-3">
                    <button type="submit" class="btn btn-primary">Criar colaborador</button>
                    <a href="{{ route('clientes') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                </div>

            </div>

        </form>

    </div>
       <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>   
    
    <script>
           $(document).ready(function(){
              $('.date').mask('00/00/0000');
              $('.time').mask('00:00:00');
              $('.date_time').mask('00/00/0000 00:00:00');
              $('.cns').mask('000.0000.0000.0000');
              $('.cep').mask('00000-000');
              $('.phone').mask('0000-0000');
              $('.telefone').mask('(00)00000-0000');
              $('.phone_us').mask('(000) 000-0000');
              $('.mixed').mask('AAA 000-S0S');
              $('.cpf').mask('000.000.000-00', {reverse: true});
              $('.cnpj').mask('00.000.000/0000-00', {reverse: true});
              $('.money').mask('000.000.000.000.000,00', {reverse: true});
              $('.money2').mask("#.##0,00", {reverse: true});
              $('.ip_address').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
                translation: {
                  'Z': {
                    pattern: /[0-9]/, optional: true
                  }
                }
              });
              $('.ip_address').mask('099.099.099.099');
              $('.percent').mask('##0,00%', {reverse: true});
              $('.clear-if-not-match').mask("00/00/0000", {clearIfNotMatch: true});
              $('.placeholder').mask("00/00/0000", {placeholder: "__/__/____"});
              $('.fallback').mask("00r00r0000", {
                  translation: {
                    'r': {
                      pattern: /[\/]/,
                      fallback: '/'
                    },
                    placeholder: "__/__/____"
                  }
                });
              $('.selectonfocus').mask("00/00/0000", {selectOnFocus: true});
            });
        
    </script>

</x-layout-app>
