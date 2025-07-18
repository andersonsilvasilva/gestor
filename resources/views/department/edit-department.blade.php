<x-layout-app page-title='Edite o Departamento'>
    <div class="w-25 p-4">

        <h3>Edite departamento</h3>

        <hr>

        <form action="{{ route('departments.update-department') }}" method="post">

            @csrf

            <input type="hidden" name="id" value="{{ $department->id }}">

            <div class="mb-3">
                <label for="name" class="form-label">Nome Departamento</label>
                <input type="text" class="form-control" id="name" name="name" required value="{{ $department->name }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror                
            </div>

            <div class="mb-3">
                <a href=" {{ route('departments') }}" class="btn btn-outline-danger me-3">Cancelar</a>
                <button type="submit" class="btn btn-primary">Alterar </button>
            </div>

        </form>

    </div>

</x-layout-app>
