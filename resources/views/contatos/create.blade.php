@extends('layout')

@section('title', 'Novo Contato')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow -sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Novo Contato</h4>
                    <a href="{{ route('index') }}" class="btn btn-secondary">Voltar</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('contatos.store') }}" method="POST">
                        @csrf

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nome" class="form-label">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="telefone" class="form-label">Telefone</label>
                                <input type="text" name="telefone" id="telefone" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="idade" class="form-label">Idade</label>
                                <input type="number" name="idade" id="idade" class="form-control" required>
                            </div>
                        </div>

                        <hr>
                        <h6>Endereço</h6>

                        <div class="row mb-3">
                            <div class="col-md-3">
                                <label for="cep" class="form-label">CEP</label>
                                <input type="text" name="cep" id="cep" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="rua" class="form-label">Rua</label>
                                <input type="text" name="rua" id="rua" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="numero" class="form-label">Numero</label>
                                <input type="text" name="numero" id="numero" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="complemento" class="form-label">Complemento</label>
                                <input type="text" name="complemento" id="complemento" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label for="cidade" class="form-label">Cidade</label>
                                <input type="text" name="cidade" id="cidade" class="form-control" required>
                            </div>
                            <div class="col-md-2">
                                <label for="estado" class="form-label">Estado</label>
                                <input type="text" name="estado" id="estado" class="form-control" required>
                            </div>
                        </div>    

                        <button type="submit" class="btn btn-success">Salvar</button>
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
            const cep = document.getElementById('cep');
            const rua = document.getElementById('rua');
            const cidade = document.getElementById('cidade');
            const estado = document.getElementById('estado');
            const complemento = document.getElementById('complemento');

            if (telefone) {
                IMask(telefone, {
                    mask: [
                        { mask: '(00) 00000-0000'},
                        { mask: '(00) 0000-0000'}
                    ]
                });
            } 

            if (cep) {
                IMask(cep, { mask: '00000-000' });
            cep.addEventListener('blur', function () {
                const rawCep = cep.value.replace(/\D/g, '');

                if (rawCep.length === 8) {
                    fetch(`https://viacep.com.br/ws/${rawCep}/json/`)
                        .then(response => response.json())
                        .then(data => {
                            if (!data.erro) {
                                rua.value = data.logradouro || '';
                                rua.readOnly = !!data.logradouro;

                                cidade.value = data.localidade || '';
                                cidade.readOnly = !!data.localidade;

                                estado.value = data.uf || '';
                                estado.readOnly = !!data.estado;

                                complemento.value = data.complemento || '';
                                complemento.readOnly = !!data.complemento;

                            } else {
                                alert('CEP não encontrado.');
                            }
                        })
                        .catch(() => {
                            alert('Erro ao consultar o CEP.');
                        });
                }
            });
        }
    });
    </script>
@endpush