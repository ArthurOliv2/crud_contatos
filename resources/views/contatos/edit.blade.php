@extends('layout')

@section('title', 'Editar Contato')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow -sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Editar Contato</h4>
                    <a href="{{ route('index') }}" class="btn btn-danger">Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('contatos.update', $contato) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $contato->nome) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" value="{{ old('telefone', $contato->telefone) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="idade" class="form-label">Idade</label>
                                <input type="number" name="idade" id="idade" class="form-control" value="{{ old('idade', $contato->idade) }}" required>
                            </div>
                        </div>

                        <hr>
                        <h6>Endereço</h6>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" value="{{ old('cep', $contato->cep) }}"required>
                            </div>
                            <div class="col-md-6">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" name="rua" id="rua" class="form-control" value="{{ old('rua', $contato->rua) }}" required>
                            </div>
                            <div class="col-md-3">
                                <label for="numero" class="form-label">Numero</label>
                                <input type="text" name="numero" id="numero" class="form-control" value="{{ old('numero', $contato->numero) }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" name="complemento" id="complemento" class="form-control" value="{{ old('complemento', $contato->complemento) }}">
                            </div>
                            <div class="col-md-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" value="{{ old('cidade', $contato->cidade) }}" required>
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" value="{{ old('estado', $contato->estado) }}" required>
                            </div>
                        </div>    

                        <button type="submit" class="btn btn-success">Atualizar</button>
                    </form>
                </div>
            </div>
        </div>    
    </div>
</div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/imask"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const telefone = document.getElementById('telefone');
            if (telefone) {
                IMask(telefone, {
                    mask: [
                        { mask: '(00) 00000-0000'},
                    ]
                });
            } 

            const cep = document.getElementById('cep');
            if (cep) {
                IMask(cep, {
                    mask: '00000-000'
                });
            }
        });
    </script>
@endpush