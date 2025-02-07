<x-layout-app page-title="Novo Cliente">

    <div class="border-light shadow w-100 p-4">

        <h3>Novo Cliente</h3>

        <hr>

        <form  action="{{ route('cliente.create-cliente') }}" method="post">

            @csrf

            <div class="container-fluid">
                <div class="row gap-2">
                    {{-- user --}}
                    <div class="col" >
                        <div  class="row">
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="cns" class="form-label">Número do cartão do SUS</label>
                                <input type="text" class="form-control" id="cns"
                                        name="cns" maxlength="18" size=18 data-mask="000.0000.0000.0000" value="{{ old('cns') }}">
                                @error('cns')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="cpf" class="form-label">CPF</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" size=14 data-mask="000.000.000-00" value="{{ old('cpf') }}">
                                @error('cpf')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6 col-sm-12 mb-2">
                                <label for="nome" class="form-label">Nome Completo do Cliente</label>
                                <input type="text" class="form-control" id="nome" name="nome" oninput="this.value = this.value.toUpperCase()"  value="{{ old('nome') }}">
                                @error('nome')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="data_nascimento" class="form-label">Data de Nascimento</label>
                                <input type="date" class="form-control" id="data_nascimento" name="data_nascimento"  placeholder="YYYY-mm-dd" value="{{ old('data_nascimento', now()->setTimezone('T')->format('Y-m-d'))}}">
                                @error('data_nascimento')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-2 col-sm-12 mb-2">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select class="form-select" id="sexo" name="sexo" value="{{ old('sexo') }}" >
                                            <option value="">           Selecione</option>
                                            <option value="MASCULINO">  MASCULINO</option>
                                            <option value="FEMININO">   FEMININO</option>
                                        </select>
                                        @error('sexo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror

                                </div>

                                <div class="col-md-2 col-sm-12 mb-2">
                                    <div class="form-group">
                                        <label for="nacionalidade" class="form-label">Nacionalidade</label>
                                        <select class="form-select" id="nacionalidade" name="nacionalidade" value="{{ old('nacionalidade') }}">
                                            <option value="">           Selecione</option>
                                            <option value="BRASILEIRA"> BRASILEIRA</option>
                                            <option value="ESTRANGEIRA">ESTRANGEIRA</option>
                                        </select>
                                        @error('nacionalidade')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-2 col-sm-12 mb-2">
                                    <label for="cor" class="form-label">Cor</label>
                                    <select class="form-select" id="cor" name="cor" value="{{ old('cor') }}">
                                        <option value="">Selecione</option>
                                        <option value="BRANCA">     BRANCA</option>
                                        <option value="PRETA">      PRETA</option>
                                        <option value="AMARELA">    AMARELA</option>
                                        <option value="PARDA">      PARDA</option>
                                        <option value="INDIGINA">   INDÍGENA</option>
                                    </select>
                                    @error('cor')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4 col-sm-12 mb-2">
                                    <label for="etnia" class="form-label">Etnia</label>
                                    <input type="text" class="form-control" id="etnia" name="etnia" oninput="this.value = this.value.toUpperCase()"  value="{{old('etnia')}}">
                                    @error('etnia')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            <div class="col-md-2 col-sm-12 mb-2">
                                <div class="form-group">
                                    <label for="estado_civil" class="form-label">Estado Civil</label>
                                    <select class="form-select" id="estado_civil" name="estado_civil" value="{{old('estado_civil') }}" >
                                        <option value=" ">Selecione</option>
                                        <option value="SOLTEIRO(A)">    SOLTEIRO(A)</option>
                                        <option value="CASADO(A)">      CASADO(A)</option>
                                        <option value="VIÚVO(A)">       VIÚVO(A)</option>
                                        <option value="DIVORCIADO(A)">  DIVORCIADO(A)</option>
                                        <option value="UNIÃO ESTÁVEL">  UNIÃO ESTÁVEL</option>
                                    </select>
                                    @error('estado_civil')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                             </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-2 col-sm-12">
                                <label for="cep" class="form-label">Cep</label>
                                <input type="text" class="form-control" id="cep" name="cep" data-mask="00000-000"  size=8 value="{{ old('cep') }}">
                                @error('cep')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-2">
                                <div class="form-group">
                                    <label for="logradouro" class="form-label">Logradouro</label>
                                    <select class="form-select" id="logradouro" name="logradouro" value="{{ old('logradouro') }}">
                                        <option value="">           Selecione</option>
                                        <option value="RUA">        RUA</option>
                                        <option value="AVENIDA">    AVENIDA</option>
                                        <option value="TRAVESSA">   TRAVESSA</option>
                                        <option value="VIELA">      VIELA</option>
                                        <option value="TRECHO">     TRECHO</option>
                                        <option value="ALAMEDA">    ALAMEDA</option>
                                        <option value="CHÁCARA">    CHÁCARA</option>
                                        <option value="FAZENDA">    FAZENDA</option>
                                        <option value="LOTEAMENTO"> LOTEAMENTO</option>
                                        <option value="SITIO">      SITIO</option>
                                        <option value="COLONIA">    COLONIA</option>
                                        <option value="CONDOMINIO"> CONDOMINIO</option>
                                        <option value="ESTRADA">    ESTRADA</option>
                                        <option value="BECO">       BECO</option>
                                    </select>
                                    @error('logradouro')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-7 col-sm-12">
                                <label for="endereco" class="form-label">Endereço</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" oninput="this.value = this.value.toUpperCase()" value="{{ old('endereco') }}">
                                @error('endereco')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-1 col-sm-12">
                                <label for="numero" class="form-label">Número</label>
                                <input type="text" class="form-control" id="numero" name="numero" value="{{ old('numero') }}">
                                @error('numero')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 m">
                                <label for="bairro" class="form-label">Bairro</label>
                                <input type="text" class="form-control" id="bairro" name="bairro" oninput="this.value = this.value.toUpperCase()" value="{{ old('bairro') }}">
                                @error('bairro')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4 col-sm-12">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" class="form-control" id="cidade" name="cidade" oninput="this.value = this.value.toUpperCase()"  value="{{ old('cidade', "CUIABÁ" ) }}">
                                @error('cidade')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12">
                                <div class="form-group">
                                    <label for="uf" class="form-label">Estado</label>
                                    <select class="form-select" id="uf" name="uf" value="{{ old('uf'),'uf'}}">
                                        <option value="">   Selecione</option>
                                        <option value="AC"> Acre</option>
                                        <option value="AL"> Alagoas</option>
                                        <option value="AP"> Amapá</option>
                                        <option value="AM"> Amazonas</option>
                                        <option value="BA"> Bahia</option>
                                        <option value="CE"> Ceará</option>
                                        <option value="DF"> Distrito Federal</option>
                                        <option value="ES"> Espírito Santo</option>
                                        <option value="GO"> Goiás</option>
                                        <option value="MA"> Maranhão</option>
                                        <option value="MT"> Mato Grosso</option>
                                        <option value="MS"> Mato Grosso do Sul</option>
                                        <option value="MG"> Minas Gerais</option>
                                        <option value="PA"> Pará</option>
                                        <option value="PB"> Paraíba</option>
                                        <option value="PR"> Paraná</option>
                                        <option value="PE"> Pernambuco</option>
                                        <option value="PI"> Piauí</option>
                                        <option value="RJ"> Rio de Janeiro</option>
                                        <option value="RN"> Rio Grande do Norte</option>
                                        <option value="RS"> Rio Grande do Sul</option>
                                        <option value="RO"> Rondônia</option>
                                        <option value="RR"> Roraima</option>
                                        <option value="SC"> Santa Catarina</option>
                                        <option value="SP"> São Paulo</option>
                                        <option value="SE"> Sergipe</option>
                                        <option value="TO"> Tocantins</option>
                                        <option value="EX"> Estrangeiro</option>
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
                                <input type="text" class="form-control" id="telefone" name="telefone" data-mask="(00)00000-0000"  size=15  value="{{ old('telefone')}}">
                                @error('telefone')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 col-sm-12 mb-2">
                                <label for="email" class="form-label">Email</label>
                                <input type="text" class="form-control" id="email" name="email" oninput="this.value = this.value.toUpperCase()" value="{{ old('email', "NÃO INFORMADO") }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-2 col-sm-12 mb-2">
                                <label for="tipo_sangue" class="form-label">Tipo Sanguineo</label>
                                <select name="tipo_sangue" id="tipo_sangue" class="form-select" value={{old('tipo_sangue')}}>
                                    <option value="">Selecione</option>
                                    <option value="NS"> Não Sabe</option>
                                    <option value="O+"> O+</option>
                                    <option value="O-"> O-</option>
                                    <option value="A+"> A+</option>
                                    <option value="A-"> A-</option>
                                    <option value="B+"> B+</option>
                                    <option value="B-"> B-</option>
                                    <option value="AB+">AB+</option>
                                    <option value="AB-">AB-</option>
                                </select>
                                @error('tipo_sangue')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 col-sm-12 mb-2">
                                <label for="ativ_laboral" class="form-label">Atividade Laboral</label>
                                <input type="text" class="form-control" id="ativ_laboral" name="ativ_laboral" oninput="this.value = this.value.toUpperCase()" value="{{ old('ativ_laboral') }}">
                                @error('ativ_laboral')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-8 col-sm-12 mb-2">
                                <label for="observacao" class="form-label">Observação</label>
                                <input type="text" class="form-control" id="observacao" name="observacao"  oninput="this.value = this.value.toUpperCase()" value="{{ old('observacao') }}">
                               </div>
                        </div>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ route('clientes') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>

            </div>

        </form>

    </div>

    {{--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>--}}
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>


    <!-- Adicionando Javascript -->
    <script type="text/javascript">

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#cep").val("");
                $("#endereco").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#cep").focus();
                //$("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#endereco").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        //$("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                rua= dados.logradouro.toUpperCase();
                                bairro = dados.bairro.toUpperCase();
                                cidade = dados.localidade.toUpperCase();
                                uf = dados.uf.toUpperCase();
                                $("#logradouro").val("RUA");
                                $("#endereco").val(rua);
                                $("#bairro").val(bairro);
                                $("#cidade").val(cidade);
                                $("#uf").val(uf);
                                $("#numero").focus();
                                //$("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                Swal.fire({
                                        position: "top-center",
                                        icon: "error",
                                        title: "CEP não encontrado!",
                                        showConfirmButton: false,
                                        timer: 2500
                                });
                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        Swal.fire({
                            position: "top-center",
                            icon: "error",
                            title: "CEP não encontrado!",
                            showConfirmButton: false,
                            timer: 2500
                        });
                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>
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

