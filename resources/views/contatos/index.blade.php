@extends('layout')

@section('title', 'Lista de Contatos')

@section('content')
<div class="container mt-4">    
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Lista de Contatos</h4>
                    <a href="{{ route('contatos.create') }}" class="btn btn-primary">Adicionar Contato</a>
                </div>

                <div class="card-body">   
                    <div class="d-flex justify-content-end mb-3">
                        <form method="GET" action="{{ route('index') }}" class="input-group input-group-sm">
                            <input type="text" name="busca" class="form-control-sm me-2" placeholder="Buscar por nome ..." value="{{ request('busca') }}">
                                <button class="btn btn-sm btn-outline-secondary" type="submit">
                                    <i class="bi bi-search"></i> Buscar
                                </button>
                        </form>
                    </div>
                    
                    @if (@session('success'))
                        <div id="alert-message" class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nome</th>
                                <th>Idade</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($contatos as $contato)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $contato->nome }}</td>
                                    <td>{{ $contato->idade }}</td>
                                    <td>{{ $contato->telefone }}</td>
                                    <td class="text-nowrap">
                                        <button type="button"
                                        class="btn btn-sm btn-secondary me-1"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalEndereco{{ $contato->id }}">
                                            <i class="bi bi-geo-alt-fill me-1"></i> Exibir Endereço
                                        </button>

                                        <a href="{{ route('contatos.edit', $contato) }}"
                                        class="btn btn-sm btn-success btn-sm me-1"
                                        title="Editar Contato">
                                            <i class="bi bi-pencil-square me-1"></i> Editar
                                        </a>

                                        <form action="{{ route('contatos.destroy', $contato) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Tem certeza que deseja excluir ?')"
                                            class="btn btn-sm btn-danger"
                                            title="Excluir contato">
                                                <i class="bi bi-trash3 me-1"></i> Excluir
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <div class="modal fade" id="modalEndereco{{ $contato->id }}" tabindex="-1" aria-labelledby="modalLabel{{ $contato->id}}" aria-hidden="true">   
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalLabel{{ $contato->id }}">Endereço de {{ $contato->nome }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p><strong>Rua:</strong> {{ $contato->rua }}, nº {{ $contato->numero}}</p>
                                                <p><strong>Complemento:</strong> {{ $contato->complemento }}</p>
                                                <p><strong>CEP:</strong> {{ $contato->cep }}</p>
                                                <p><strong>Cidade:</strong> {{ $contato->cidade }}/{{ $contato->estado }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>      
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>                
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const alert = document.getElementById('alert-message');
            if (alert) {
                setTimeout(() => {
                    alert.classList.remove('show');
                    alert.classList.add('fade');
                    setTimeout(() => alert.remove(), 300);
                }, 3000);
            }
        });
    </script>
@endpush

