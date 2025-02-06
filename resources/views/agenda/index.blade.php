<x-layout-app page-title="Calendario">
    <!-- Chamada do Calendario -->
    <div class="container-flex">

        <div class="row">
            <div class="flex-nowrap mb-3 mb-0">
                <div class="float-start">
                    <h3>Agenda</h3>
                </div>
             
                <div class="float-end">
                    <a href="{{ route('clientes',['id' => Crypt::encrypt($cliente->id)]) }}" class="btn btn-success me-2 mb-2">{{__('Voltar')}}</a>
                </div>
            
            </div>
            <hr>
        </div>
        <div class="row">
                <div class="col-sm-24  mt-0 mb-0">
                    <div id="calendar" > </div>
                </div>
        </div>
    </div>

    <!-- Modal visualizar -->
    <div class="modal fade bd-example-modal-lg" id="vModal" tabindex="-1" aria-labelledby="vModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="vModalLabel">Informações sobre o atendimento</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <span id='titleError' class="text-danger"></span>

                    <dl class="row">

                        <dd class="col-sm-3">Cartão Nacional SUS:</dd>
                        <dt class="col-sm-9"  id="visualizar_codigo" ></dt>
                        
                        <dd class="col-sm-3">Nome:</dd>
                        <dt class="col-sm-9" id="visualizar_nome"></dt>
                        
                        <dd class="col-sm-3">Telefone:</dd>
                        <dt class="col-sm-9" id="visualizar_telefone"></dt>
                        
                        <dd class="col-sm-3">Inicio:</dd>
                        <dt class="col-sm-9" id="visualizar_start"></dt>

                        <dd class="col-sm-3">Fim:</dd>
                        <dt class="col-sm-9" id="visualizar_end"></dt>

                        <dd class="col-sm-3">Terapeuta:</dd>
                        <dt class="col-sm-9" id="visualizar_terapeuta"></dt>

                        <dd class="col-sm-3">Procedimento:</dd>
                        <dt class="col-sm-9" id="visualizar_procedimento"></dt>
                         
                        <dd class="col-sm-3"><b>Sobre o Atendimento:</b></dd>
                        <dt class="col-sm-8 shadow-light alert alert-dark"  id="visualizar_descricao"></dt>
                    </dl>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Cadastrar -->
    <div class="modal fade bd-example-modal-lg" id="cModal" tabindex="-1" aria-labelledby="cModalLabel" aria-hidden="true" style="display: : nono !important;">
        <div class="modal-dialog modal-lg modal-dialog-top modal-dialog"> {{--centered --}}
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="cadastrarModalLabel">Cadastrar o atendimento</h3>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="close"></button>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <form action="{{ URL('/create-agenda')}}" method="POST" id="form-add-event"> {{-- enctype="multipart/form-data"> --}}
                            @csrf

                            <input type="hidden" name="client_id" id="client_id" value="{{ old('client_id',$cliente->id)}}">

                            <label for='title'><b>{{ __('Titulo') }}</b></label>
                            <input type='text' class='bg-info text-dark form-control' id='title' name='title' value='{{ old('title',$cliente->nome)}}'>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                            
                            <label for="start"><b>{{__('Inicio')}}></b></label>
                            <input type='datetime-local' class='bg-info text-dark form-control' id='start' name='start'>
                            @error('start')
                                <div class="text-danger"><b>{{ $message }}</b></div>
                            @enderror

                            <label for="end"><b>{{__('Fim')}}</b></label>
                            <input type='datetime-local' class='bg-info text-dark form-control' id='end' name='end'>
                            @error('end')
                                <div class="text-danger"><b>{{ $message }}</b></div>
                            @enderror

                            <label for='user_id'><b>{{ __('Terapeuta') }}</b></label>
                            <input type='hidden' id='user_id' name='user_id' value="{{ old('user_id',$terapeutas->id)}}">
                            <label for="terapeuta_name" id='terapeuta_name' class="bg-info text-dark form-control">{{$terapeutas->name}}</label> 

                            <label for='procediments_id'><b>{{ __('Procedimento') }}</b></label>
                            <select class='bg-info text-dark form-select' id='procediments_id' name='procediments_id' value='{{ old('procediments_id')}}'>
                                <option value="">Escolha um procedimento <strong> **OBRIGATÓRIO**</strong></option>
                                @foreach ($procedimentos as $procedimento)
                                    <option value="{{ $procedimento->id }}">{{ $procedimento->name }}</option>
                                @endforeach
                            </select>
                            @error('procediments_id')
                                <div class="text-danger"><b>{{ $message }}</b></div>
                            @enderror
                            
                            <label for="color"><b>{{__('Escolha uma Cor para o Evento')}}</b></label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="#f6b73c">
                            @error('color')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                                                    
                            <label for='descricao'><b>{{ __('Sobre o Atendimento') }}</b></label>
                            <textarea class="bg-info text-dark form-control" id="descricao" name="descricao" rows="7" cols="30" maxlength="1000" placeholder="Escreva aqui o atendimento realizado" value='{{ old('descricao')}}'></textarea>
                            @error('descricao')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror


                            <div class="modal-footer">
                                <div class="mt-3">
                                    <button type="submit" id="saveBtn" class="btn btn-outline-danger">Gravar</button>
                                    <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button>
                                </div>
                            </div>

                        </div>
                    </div>
  
                </form>
            </div>
        </div>
    </div>

    <!-- custom fullcallender-->


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <!-- resources do locale do fullcallender-->   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@7.0.0-beta.1/index.global.min.js'></script>
    <script src="https://momentjs.com/downloads/moment.js"></script>
    <script src="{{ asset('assets/js/bootstrap5/index.global.min.js')}}"></script>
    <script src="{{ asset('assets/js/core/locales/pt-br.global.min.js')}}"></script>
    <script src="{{ asset('assets/js/custom2.js') }}"></script>  
    <script src="{{ asset('/ckeditor/ckeditor.js') }}"></script> 

    <script>
        document.addEventListener('DOMContentLoaded', function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var calendarEl=document.getElementById('calendar');
        var events =[];
        var calendar=new FullCalendar.Calendar(calendarEl,{
            themeSystem: 'bootstrap5',
            headerToolbar:{
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth',
            },
            locale: 'pt-BR',
            initialView: 'timeGridWeek',
            timeZone: 'America/Cuiaba',
            events: '/events',
            slotMinTime: "06:00:00",
            slotMaxTime: "18:00:00",
            navLinks: true,
            editable: true,
            selectable: true,
            droppable: true,
            selectMirror: true,
            businessHours: true, 
            dayMaxEventRows: true,            
            businessHours: {
                daysOfWeek: [ 1, 2, 3, 4, 5, 6], // Monday - Thursday              
                startTime: '07:00', // a start time (10am in this example)
                endTime: '17:00', // an end time (6pm in this example)
            },
            eventClick: function (info) {
                abrirVisual(info);
            },
            dateClick: function (info) {
                abrirModal(info);                
            }, 
            select: function(info) {
                criarModal(info);                     
            }, 
            eventContent: function(info) {                  
                var eventTitle = nomeShort(info.event.title);
                var labelColor= info.event.color || '#FFFF00';
                var newStartDate = info.event.start;
                var newStartDateUTC = newStartDate.toISOString().slice(11, 16);
                var eventElement = document.createElement('div');
                eventElement.innerHTML = '<span style="background-color:"'+labelColor+'cursor: pointer>✖️</span> '+newStartDateUTC+'-'+ eventTitle;
                eventElement.querySelector('span').addEventListener('click', function() {
                        if (confirm("Você tem certeza que deseja apagar este evento?")) {
                            var eventId = info.event.id;
                            $.ajax({
                                method: 'get',
                                url: '/agenda/delete/' + eventId,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                success: function(response) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "success",
                                        title: "Evento deletado com sucesso.",
                                        showConfirmButton: false,
                                        timer: 1500                                        
                                    });
                                    calendar.refetchEvents(); // Refresh events after deletion
                                    console.log('Evento deletado com sucesso.');
                                    
                                },
                                error: function(error) {
                                    Swal.fire({
                                        position: "top-end",
                                        icon: "error",
                                        title: "Erro ao deletar o evento.",
                                        showConfirmButton: false,
                                        timer: 1500                                        
                                    });
                                    calendar.refetchEvents(); // Refresh events after deletion
                                    console.error('Erro ao apagar o evento:', error);
                                }
                            });
                        }
                });
                return {
                    domNodes: [eventElement]
                };                
            },                
            eventDrop: function(info) {
                moverEvento(info);                
            },
            eventResize: function(info) {
                moverEvento(info);;
            },
            selectAllow: function(info)
            {
                return moment(info.start).utcOffset(false).isSame(moment(info.end).subtract(1, 'second').utcOffset(false), 'day');
            }
        });
        //redenderizar o calendario
        calendar.render();

        //Aqui começa as rotinas de controle da Agenda
        const cadastrarModal = new bootstrap.Modal(document.getElementById("cModal"));
        //Rotina para Abrir o Modal
        const abrirModal = (info) => {  
            /*
            var newStartDate    = info.start;
            var newEndDate      = info.end || newStartDate;
            document.getElementById("start").value  = moment(newStartDate).format('YYYY-MM-DD HH:MM');
            document.getElementById("end").value    = moment(newEndDate).format('YYYY-MM-DD HH:MM');
            */
        }            
        //Rotina para Visualizar os dados do Evento
        const abrirVisual = (info) => {
           
            //recebe o seletor da janela modal
            info.el.style.borderColor = 'red';
            const VisualizarModal = new bootstrap.Modal(document.getElementById("vModal"));
            //Enviar para a janela modal os dados
            document.getElementById('visualizar_codigo').innerText = info.event.extendedProps.codigo;
            document.getElementById('visualizar_nome').innerText = info.event.extendedProps.nomecliente;
            document.getElementById('visualizar_start').innerText = info.event.start.toLocaleString("pt-Br",{ dateStyle: "short",timeStyle: "short", timeZone: "UTC" });
            document.getElementById('visualizar_end').innerText = info.event.end.toLocaleString("pt-Br",{dateStyle: "short", timeStyle: "short", timeZone: "UTC" });
            document.getElementById('visualizar_terapeuta').innerText = info.event.extendedProps.terapeuta;
            document.getElementById('visualizar_procedimento').innerText = info.event.extendedProps.procedimento;
            document.getElementById('visualizar_descricao').innerHTML = info.event.extendedProps.descricao;  
            document.getElementById('visualizar_telefone').innerText = info.event.extendedProps.telefone;    
            //abrir a janela modal Visualizar
            VisualizarModal.show();

        }     
        //Rotina para Criar Evento
        const criarModal = (info) => {
            $('#cModal').modal('toggle');

                var newStartDate    = info.start;
                var newEndDate      = info.end || newStartDate;
                document.getElementById("start").value  = moment.utc(newStartDate).format('YYYY-MM-DD HH:mm');
                document.getElementById("end").value    = moment.utc(newEndDate).format('YYYY-MM-DD HH:mm');

            $('#saveBtn').click(function () {
                var newStartDate    = info.event.start;
                var newEndDate      = info.event.end || newStartDate;
                //var newStartDateUTC = newStartDate.toISOString().slice(0, 20);
                //var newEndDateUTC   = newEndDate.toISOString().slice(0, 20);
                let start_date =  moment.utc(newStartDate ).format('YYYY-MM-DD HH:mm');
                let end_date   =  moment.utc(newEndDate).format('YYYY-MM-DD HH:mm');                
                let title = $('#title').val();
                let client_id = client_id;
                let user_id = user_id;
                let descricao = CKEDITOR.instances.descricao.getDate();
                let color = color;
                let procediments_id = procediments_id;         
                $.ajax({
                    url: "{{ route('agenda.store') }}",
                    method: `POST`,
                    dataType: `json`,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {title, start_date, end_date, client_id, procediments_id, user_id, descricao, color
                    },
                    success: function (response) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Evento criado com sucesso.",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        $('#cModal').modal('hide');
                        $('#calendar').fullCalendar('renderEvent', {
                            'client_id':        response.client_id,
                            'procediments_id':  response.procediments_id,
                            'user_id':          response.user_id,
                            'title':            response.title,
                            'start':            response.start_date,
                            'end':              response.end_date,
                            'descricao':        response.descricao,
                            'color':            response.color
                        });
                        calendar.refetchEvents();
                        console.log('Evento criado com sucesso.');
                    },
                    error: function (error) {
                        if (error.responseJSON.errors) {
                            $('#titleError').html(error.responseJSON.errors.title);
                        }
                        Swal.fire({
                            position: "top-end",
                            icon: "error",
                            title: "Erro ao cadastrar o evento.",
                            showConfirmButton: false,
                            timer: 2500
                        });
                        calendar.refetchEvents();
                        console.error('Erro ao criar o evento.');
                    },
                    
                });
            });
        };
        //Rotina para apagar Evento
        const moverEvento = (info) => {
            var eventId         = info.event.id;
            var newStartDate    = info.event.start;
            var newEndDate      = info.event.end || newStartDate;
            var newStartDateUTC = newStartDate.toISOString().slice(0, 20);
            var newEndDateUTC   = newEndDate.toISOString().slice(0, 20);
            $.ajax({
                 method: 'post',
                url: "/agenda/mover/" + eventId,
                headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                   '_token': "{{ csrf_token() }}",
                   start_date: newStartDateUTC,
                   end_date:   newEndDateUTC
                },
                success:function() {
                    calendar.refetchEvents(); // Refresh events after mover
                    Swal.fire({
                       position: "top-end",
                       icon: "success",
                       title: "Evento atualizado com sucesso.",
                       showConfirmButton: false,
                       timer: 1500
                                
                    });
                    calendar.refetchEvents();
                    console.log('Evento movido com sucesso.');
                },
                error:function(error) {
                    Swal.fire({
                       position: "top-end",
                       icon: "error",
                       title: "Erro ao atualizar o evento.",
                       showConfirmButton: false,
                       timer: 1500
                    });
                   calendar.refetchEvents();
                   console.error('Erro ao mover o evento:', error);
                }
                
            });

        };

        //Função para encurtar o nome do cliente
        function nomeShort(nameShort) {
            var nameShort = nameShort.split(' ');
            nameShort = nameShort.slice(0, 1) + ' ' + nameShort.slice(-1);
            return nameShort;
        };

        //Função para converter a string em um objeto Date
        function converterData(data) {
            // Converter a string em um objeto Date
            const dataObj = new Date(data);
            // Extrair o ano da data
            const ano = dataObj.getFullYear();
            // Obter o mês, mês começa de 0, padStart adiciona zeros à esquerda para garantir que o mês tenha dígitos
            const mes = String(dataObj.getMonth()).padStart(2, '0');
            // Obter o dia do mês, padStart adiciona zeros à esquerda para garantir que o dia tenha dois dígitos
            const dia = String(dataObj.getDate() + 1).padStart(2, '0');
            // Obter a hora, padStart adiciona zeros à esquerda para garantir que a hora tenha dois dígitos
            const hora = String(dataObj.getHours() + 1).padStart(2, '0');
            // Obter minuto, padStart adiciona zeros à esquerda para garantir que o minuto tenha dois dígitos
            const minuto = String(dataObj.getMinutes()).padStart(2, '0');
            // Retornar a data
            return `${ano}-${mes}-${dia} ${hora}:${minuto}`;
        };

    });
    </script>

</x-layout-app>