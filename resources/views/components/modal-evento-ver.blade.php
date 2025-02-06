<div  
x-data = "{
    user:{
        title: 'Anderson Barros',
        start: '2025-02-01 08:00:00',
        end:   '2025-02-01 09:00:00',
        color: '#f6b73c',
        user_id: '2',
        procedimento: 'Acolhimento',
        ddescricao: 'Descreva o atendimento'
    },
    errors:[],
    success:'',
    modal:{},
    openModale(event){

        if(Object.keys(event.detail).length){
            this.user = event.detail;    
        }
        this.myModal = new bootstrap.Modal('#modal-eventover');
        this.myModal.show();
    },
   /* async send(){
        const token = document.querySelector('#__token').getAttribute('content');

        const response = await fetch('/eventos/update', {
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN':token,
                'Content-Type':'application/json'
                    },
            body: JSON.stringify(this.user)
        })

        let data = await response.json(); 
        console.log(data);

        if(response.ok){
            this.success = data.success;

            setTimeout(() => {
              location.reload(true)
            },1000);

            setTimeout(() => {
                this.success = '';
                this.myModal.hide();                
            }, 2000);
            return;
        }

        this.errors = data.errors; 
        setTimeout(() => {
            this.errors =[];
        }, 3000);

    }
   */

}",
@open-evento-modale.window="openModale"
>

    <div class="modal fade" tabindex="-2" id='modal-eventover' aria-labelledby=modal-eventoverLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fs-5">Dados do atendimento</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>  
                <template x-if="success">
                    <span class="alert alert-success text-center mt-3" x-text="success"></span>
                </template>       
                <form x-on:submit.prevent="send">
                        <div class="modal-body">

                            <label class="form-label" for='title'><b>Titulo</b></label>
                            <template x-if="errors.title">
                                <span class="text text-danger" x-text="errors.title"></span>
                            </template>
                            <input type='text' x-model='user.title' class='form-control'  disabled>

                            <label for="start"><b>{{__('Inicio')}}></b></label>
                            <template x-if="errors.start">
                                <span class="text text-danger" x-text="errors.title"></span>
                            </template>
                            <input type='datetime-local' x-model='user.start' class='form-control'  disabled >

                            
                            <label for="end"><b>{{__('Fim')}}</b></label>
                            <template x-if="errors.end">
                                <span class="text text-danger" x-text="errors.title"></span>
                            </template>
                            <input type='datetime-local'  x-model='user.end' class='form-control'  disabled>

                            <label for='user_id'><b>{{ __('Terapeuta') }}</b></label>
                            <input type='text' x-model='user.terapeuta' class='form-control'  disabled>

                            <label for='procediments_id'><b>{{ __('Procedimento') }}</b></label>
                            <input type='text' x-model='user.procedimento' class='form-control'  disabled>
                            
                            <label for="color"><b>{{__('Cor do Evento')}}</b></label>
                            <template x-if="errors.color">
                                <span class="text text-danger" x-text="errors.color"></span>
                            </template>
                            <input type="color" x-model='user.color' class="form-control form-control-color"  >

                            <label for='descricao'><b>{{ __('Descreva o atendimento') }}</b></label>
                            <template x-if="errors.descricao">
                                <span class="text text-danger" x-text="errors.descricao"></span>
                            </template>                           
                            <textarea  x-model="user.descricao" 
                                class="border-2 border-gray-500  bg-light text-dark form-control"  
                                placeholder="Escreva aqui o atendimento realizado"
                                rows="7" maxlength="1024">
                            </textarea>
                                          
                        </div> 
                          
                        <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Fechar</button> 
                        </div>
                </form> 
            </div>
        </div>
    </div>
</div>
