<x-layout-app page-title='Edite o Procedimento'>
    <div class="w-50 p-4">

        <h3>Edite Procedimento</h3>

        <hr>

        <form action="{{ route('procedimentos.update-Procedimento') }}" method="post">

            @csrf

            <input type="hidden" name="id" value="{{ $procedimento->id}}">

            <div class="mb-3">
                <label for="codigo" class="form-label">Codigo Procedimento</label>
                <input type="text" class="form-control" id="codigo" name="codigo" required value="{{ old('codigo', $procedimento->codigo) }}">
                @error('codigo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                
            </div>
            <div class="mb-3">
                <label for="name" class="form-label">Nome do Procedimento</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ old('name', $procedimento->name) }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                
            </div>
            <div class="mb-3">
                <fieldset>
                    <h5>Este Procedimento está Ativo</h5>
                    <div>
                      <input type="checkbox" name="ativo" value="{{ old('ativo',$procedimento->ativo)}}">
                      <label for="ativo" class="form-label"></label>
                    </div>
                </fieldset>   
            </div>

            <div class="mb-3">
                <a href="{{ route('procedimentos')}}" class="btn btn-outline-danger me-3">Cancelar</a>
                <button type="submit" class="btn btn-primary">Alterar </button>
            </div>

        </form>

    </div>

</x-layout-app>
