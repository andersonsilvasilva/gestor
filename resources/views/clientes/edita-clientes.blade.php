<x-layout-app page-title="Editar a Ficha do Cliente">

    <div class="border-light shadow w-100 p-3">
        <h4>Alterar o Cliente</h4>
        <hr>

        @if($errors->any())
            <span classe="alert alert-dange" style="color: #ff0000;">
                @foreach ($errors->all() as $error)
                    {{ errors }} <br>                    
                @endforeach

            </span>
            <br>
        @endif

        <form action="{{ route('cliente.update-cliente',  ['id' => Crypt::encrypt($clientes->id)]) }}" method="post">

            @csrf

            <input type="hidden"  name="id" value="{{ $clientes->id }}"> 

            <div class="container-fluid">
                <div class="row gap-2">
                    {{-- Editar cliente --}}
                    <div class="col" >
                        <div  class="row">
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="cns" class="form-label">Número do cartão do SUS</label>
                                <input type="text" class="form-control" id="cns" 
                                        name="cns" maxlength="20" size=20 data-mask="000.0000.0000.0000" value="{{ old('cns', $clientes->cns) }}">
                                @error('cns')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" size=14 data-mask="000.000.000-00" value="{{ old('cpf',$clientes->cpf) }}">
                                @error('cpf')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="col-md-6 col-sm-12 mb-2">
                                <label for="nome" class="form-label">Nome Completo do Cliente</label>
                                <input type="text" class="form-control" id="nome" name="nome" oninput="this.value = this.value.toUpperCase()" value="{{ old('nome', $clientes->nome) }}">
                                @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"  placeholder="YYYY-mm-dd" value="{{ old('data_nascimento', $clientes->data_nascimento) }}">
                                @error('data_nascimento')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-2 col-sm-12 mb-2">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select name="sexo" class="form-select {{$errors->has('sexo')?'is-invalid':''}}" id="sexo">
                                            <option value="" selected> Selecione</option>
                                            <option {{$clientes->sexo == "MASCULINO"       ? 'selected': ''}} value="MASCULINO">MASCULINO</option>
                                            <option {{$clientes->sexo == "FEMÍNINO"        ? 'selected': ''}} value="FEMÍNINO">FEMÍNINO</option>
                                        </select>
                                        @error('sexo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
  
                                </div>
    
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label for="nacionalidade" class="form-label">Nacionalidade</label>                   
                                        <select name="nacionalidade" class="form-select {{$errors->has('nacionalidade')?'is-invalid':''}}" id="nacionalidade" >
                                            <option value="" selected> Selecione</option>
                                            <option {{$clientes->nacionalidade == "BRASILEIRA"      ? 'selected': ''}} value="BRASILEIRA">BRASILEIRA</option>
                                            <option {{$clientes->nacionalidade == "ESTRANGEIRA"     ? 'selected': ''}} value="ESTRANGEIRA">ESTRANGEIRA</option>
                                        </select>
                                        @error('nacionalidade')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>        
                                </div>
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <label for="cor" class="form-label">Cor</label>                  
                                    <select name="cor" class="form-select {{$errors->has('cor')?'is-invalid':''}}" id="cor" >
                                        <option value="" selected> Selecione</option>
                                        <option {{$clientes->cor == "BRANCA"     ? 'selected': ''}} value="BRANCA">     BRANCA</option>
                                        <option {{$clientes->cor == "PRETA"      ? 'selected': ''}} value="PRETA">      PRETA</option>
                                        <option {{$clientes->cor == "AMARELA"    ? 'selected': ''}} value="AMARELA">    AMARELA</option>
                                        <option {{$clientes->cor == "PARDA"      ? 'selected': ''}} value="PARDA">      PARDA</option>
                                        <option {{$clientes->cor == "INDÍGENA"   ? 'selected': ''}} value="INDÍGENA">   INDÍGENA</option>
                                    </select>    
                                    @error('cor')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 mb-2">
                                    <label for="etnia" class="form-label">Etnia</label>
                                    <input type="text" class="form-control" id="etnia" name="etnia" oninput="this.value = this.value.toUpperCase()" value="{{ old('etnia', $clientes->etnia) }}">
                                    @error('etnia')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                            <div class="col-md-2 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                    <select  name="estado_civil" class="form-select {{$errors->has('estado_civil')?'is-invalid':''}}" id="estado_civil">
                                        <option value="" selected> Selecione</option>
                                        <option {{$clientes->estado_civil == "SOLTEIRO(A)"      ? 'selected': ''}} value="SOLTEIRO(A)">SOLTEIRO(A)</option>
                                        <option {{$clientes->estado_civil == "CASADO(A)"        ? 'selected': ''}} value="CASADO(A)">CASADO(A)</option>
                                        <option {{$clientes->estado_civil == "VIÚVO(A)"         ? 'selected': ''}} value="VIÚVO(A)">VIÚVO(A)</option>
                                        <option {{$clientes->estado_civil == "DIVORCIADO(A)"    ? 'selected': ''}} value="DIVORCIADO(A)">DIVORCIADO(A)</option>
                                        <option {{$clientes->estado_civil == "UNIÃO ESTÁVEL"    ? 'selected': ''}} value="UNIÃO ESTÁVEL">NIÃO ESTÁVEL</option>
                                    </select>
                                    @error('estado_civil')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                             </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <select  name="logradouro" class="form-select {{$errors->has('logradouro')?'is-invalid':''}}" id="logradouro">
                                        <option value="" selected> Selecione</option>
                                        <option {{$clientes->logradouro == "RUA"            ? 'selected': ''}} value="RUA">RUA</option>
                                        <option {{$clientes->logradouro == "AVENIDA"        ? 'selected': ''}} value="AVENIDA">AVENIDA</option>
                                        <option {{$clientes->logradouro == "TRAVESSA"       ? 'selected': ''}} value="TRAVESSA">TRAVESSA</option>
                                        <option {{$clientes->logradouro == "VIELA"          ? 'selected': ''}} value="VIELA">VIELA</option>
                                        <option {{$clientes->logradouro == "ALAMEDA"        ? 'selected': ''}} value="ALAMEDA">ALAMEDA</option>
                                        <option {{$clientes->logradouro == "CHACÁRA"        ? 'selected': ''}} value="CHACÁRA">CHACÁRA</option>
                                        <option {{$clientes->logradouro == "FAZENDA"        ? 'selected': ''}} value="FAZENDA">FAZENDA</option>
                                        <option {{$clientes->logradouro == "LOTEAMENTO"     ? 'selected': ''}} value="LOTEAMENTO">LOTEAMENTO</option>
                                        <option {{$clientes->logradouro == "SITIO"          ? 'selected': ''}} value="SITIO">SITIO</option>
                                        <option {{$clientes->logradouro == "COLÔNIA"        ? 'selected': ''}} value="COLÔNIA">COLÔNIA</option>
                                        <option {{$clientes->logradouro == "CONDOMíNIO"     ? 'selected': ''}} value="CONDOMíNIO">CONDOMíNIO</option>
                                        <option {{$clientes->logradouro == "ESTRADA"        ? 'selected': ''}} value="ESTRADA">ESTRADA</option>
                                        <option {{$clientes->logradouro == "BECO"           ? 'selected': ''}} value="BECO">BECO</option>
                                    </select>
                                    @error('logradouro')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" oninput="this.value = this.value.toUpperCase()" value="{{ old('endereco', $clientes->endereco) }}">
                                @error('endereco')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero', $clientes->numero) }}">
                                @error('numero')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <label for="cep" class="form-label">Cep</label>
                                <input type="text" class="form-control" id="cep" name="cep" maxlength="9" data-mask="00000-000"  size=9 value="{{ old('cep', $clientes->cep) }}">
                                @error('cep')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 m">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" oninput="this.value = this.value.toUpperCase()" value="{{ old('bairro', $clientes->bairro) }}">
                                @error('bairro')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" oninput="this.value = this.value.toUpperCase()" default-value="CUIABÁ" value="{{ old('cidade', $clientes->cidade) }}">
                                @error('cidade')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="uf" class="form-label">Estado</label>                    
                                    <select name="uf" class="form-select {{$errors->has('uf')?'is-invalid':''}}" id="uf">
                                        <option value="" selected> Selecione</option>                                      
                                        <option {{$clientes->uf == "AC" ? 'selected': ''}} value="AC">Acre</option>
                                        <option {{$clientes->uf == "AL" ? 'selected': ''}} value="AL">Alagoas</option>
                                        <option {{$clientes->uf == "AP" ? 'selected': ''}} value="AP">Amapá</option>
                                        <option {{$clientes->uf == "AM" ? 'selected': ''}} value="AM">Amazonas</option>
                                        <option {{$clientes->uf == "BA" ? 'selected': ''}} value="BA">Bahia</option>
                                        <option {{$clientes->uf == "CE" ? 'selected': ''}} value="CE">Ceará</option>
                                        <option {{$clientes->uf == "DF" ? 'selected': ''}} value="DF">Distrito Federal</option>
                                        <option {{$clientes->uf == "ES" ? 'selected': ''}} value="ES">Espírito Santo</option>
                                        <option {{$clientes->uf == "GO" ? 'selected': ''}} value="GO">Goiás</option>
                                        <option {{$clientes->uf == "MA" ? 'selected': ''}} value="MA">Maranhão</option>
                                        <option {{$clientes->uf == "MT" ? 'selected': ''}} value="MT">Mato Grosso</option>
                                        <option {{$clientes->uf == "MS" ? 'selected': ''}} value="MS">Mato Grosso do Sul</option>
                                        <option {{$clientes->uf == "MG" ? 'selected': ''}} value="MG">Minas Gerais</option>
                                        <option {{$clientes->uf == "PA" ? 'selected': ''}} value="PA">Pará</option>
                                        <option {{$clientes->uf == "PB" ? 'selected': ''}} value="PB">Paraíba</option>
                                        <option {{$clientes->uf == "PR" ? 'selected': ''}} value="PR">Paraná</option>
                                        <option {{$clientes->uf == "PE" ? 'selected': ''}} value="PE">Pernambuco</option>
                                        <option {{$clientes->uf == "PI" ? 'selected': ''}} value="PI">Piauí</option>
                                        <option {{$clientes->uf == "RJ" ? 'selected': ''}} value="RJ">Rio de Janeiro</option>
                                        <option {{$clientes->uf == "RN" ? 'selected': ''}} value="RN">Rio Grande do Norte</option>
                                        <option {{$clientes->uf == "RS" ? 'selected': ''}} value="RS">Rio Grande do Sul</option>
                                        <option {{$clientes->uf == "RO" ? 'selected': ''}} value="RO">Rondônia</option>
                                        <option {{$clientes->uf == "RR" ? 'selected': ''}} value="RR">Roraima</option>
                                        <option {{$clientes->uf == "SC" ? 'selected': ''}} value="SC">Santa Catarina</option>
                                        <option {{$clientes->uf == "SP" ? 'selected': ''}} value="SP">São Paulo</option>
                                        <option {{$clientes->uf == "SE" ? 'selected': ''}} value="SE">Sergipe</option>
                                        <option {{$clientes->uf == "TO" ? 'selected': ''}} value="TO">Tocantins</option>
                                        <option {{$clientes->uf == "EX" ? 'selected': ''}} value="EX">Estrangeiro</option>
                                    </select>
                                    @error('uf')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" class="form-control" id="telefone" name="telefone" data-mask="(00)00000-0000"  size=15 value="{{ old('telefone', $clientes->telefone)}}">
                                @error('telefone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 col-sm-12 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" oninput="this.value = this.value.toUpperCase()" value="{{ old('email', $clientes->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="tipo_sangue" class="form-label">Tipo Sanguineo</label>                   
                                <select name="tipo_sangue" class="form-select {{$errors->has('tipo_sangue')?'is-invalid':''}}" id="tipo_sangue">
                                    <option value="" selected> Selecione</option>
                                    <option  {{$clientes->tipo_sangue == "NS" ? 'selected': ''}} value="NS">Não Sabe</option>
                                    <option  {{$clientes->tipo_sangue == "O+" ? 'selected': ''}} value="O+">O+</option>
                                    <option  {{$clientes->tipo_sangue == "O-" ? 'selected': ''}} value="O-">O-</option>
                                    <option  {{$clientes->tipo_sangue == "A+" ? 'selected': ''}} value="A+">A+</option>
                                    <option  {{$clientes->tipo_sangue == "A-" ? 'selected': ''}} value="A-">A-</option>
                                    <option  {{$clientes->tipo_sangue == "B+" ? 'selected': ''}} value="B+">B+</option>
                                    <option  {{$clientes->tipo_sangue == "B-" ? 'selected': ''}} value="B-">B-</option>
                                    <option  {{$clientes->tipo_sangue == "AB+" ? 'selected': ''}} value="AB+">AB+</option>
                                    <option  {{$clientes->tipo_sangue == "AB-" ? 'selected': ''}} value="AB-">AB-</option>
                                </select>
                                @error('tipo_sangue')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="ativ_laboral" class="form-label">Atividade Laboral</label>
                                <input type="text" class="form-control" id="ativ_laboral" name="ativ_laboral" oninput="this.value = this.value.toUpperCase()" value="{{ old('ativ_laboral', $clientes->ativ_laboral) }}">
                                @error('ativ_laboral')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 col-sm-12 mb-2">
                                <label for="observacao" class="form-label">Observação</label>
                                <input type="text" class="form-control" id="observacao" name="observacao" oninput="this.value = this.value.toUpperCase()" value="{{ old('observacao' ,$clientes->observacao) }}">
                                @error('observacao')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mb-2">
                    <a href="{{ route('clientes') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
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

