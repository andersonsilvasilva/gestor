<x-layout-app page-title='Novo Procedimento'>
    <div class="w-25 p-4">

        <h3>Novo Procedimento</h3>

        <hr>

        <form action="{{route('procedimentos.create-procedimento')}}" method="post">

            @csrf

            <div class="mb-3">
                <label for="codigo" class="form-label">Codigo do Procediemento</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required>
                @error('codigo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Procedimento</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                
            </div>
            <div class="mb-3">
                <fieldset>
                    <h5>Este Procedimento está Ativo</h5>
                    <div>
                      <input type="checkbox" name="ativo" value="1" checked>
                      <label for="ativo" class="form-label"></label>
                    </div>
                </fieldset>    
                @error('ativo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror           
            </div>

            <div class="mb-3">
                <a href=" {{ route('procedimentos')}}" class="btn btn-outline-danger me-3">Cancelar</a>
                <button type="submit" class="btn btn-primary">Criar Novo</button>
            </div>

        </form>

    </div>

</x-layout-app>