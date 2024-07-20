@extends('layouts.admin')
@section('desing')

    <div class="container mt-4 container-md-4">
    <div class="card mt-3 mb-4 border-light shadow">
        <div class="card-header d-flex justify-content-between">
            <div class="mt-1">
            <span><h3>Pesquisar</h3></span>
            </div>
        </div>

        <div class="card-body">
            <form action="{{ route('contas.index') }}">
                <div class="row">
                    <div class="container">
                        <div class=" d-flex mb-3" style="gap: 3rem">

                            <div class="align-content-center mb-3 col-md-3 col-sm-12">
                                <label class="form-label" for="nome">Nome</label>
                                <input type="text" name="nome" id="nome" class="form-control" value="{{ $nome }}" placeholder="Nome da conta">
                                <br>
                            </div>

                            <div class="col-md-3 col-sm-12">
                                <label class="form-label" for="data_inicio">Data Início</label>
                                <input type="date" name="data_inicio" id="data_inicio" class="form-control" value="{{ $data_inicio }}">
                            </div>

                            <div class="mb-3 col-md-3 col-sm-12">
                               <label class="form-label" for="data_fim">Data Fim</label>
                               <input type="date" name="data_fim" id="data_fim" class="form-control" value="{{ $data_fim }}">
                              </div>

                            <div class="ms-auto p-2">
                                <div class="col-sm-12 mt-4">
                                    <button class="btn btn-info btn-sm" type="submit">Pesquisar</button>
                                    <a href="{{ route('contas.index') }}" class="btn btn-warning btn-sm" >Limpar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
        <div id="deleteSuccess" class="alert alert-success d-none"></div>
        <div class="card shadow-sm border-blacke  ">
            <div class="card-header  d-flex justify-content-between">
                <div class="mt-1">
                    <span><h3>Lista de contas</h3></span>
                </div>
                <span>
                    <a class="btn btn-success btn-sm mt-1" href="{{ route('contas.create') }}">Cadastrar</a>
{{--                    <a class="btn btn-warning btn-sm mt-1" href="{{ route('contas.gerar-pdf') }}">Gerar PDF</a>--}}
                    <a class="btn btn-warning btn-sm mt-1" href="{{ url('gerar-pdf-conta?' . request()->getQueryString()) }}">Gerar PDF</a>
                </span>
            </div>
            <div class="card-body shadow-sm border-black" >
                <table class="table table-hover border ">
                    <thead>
                    <tr style="text-align: center" class="table-dark">
                        <th scope="col">ID</th>
                        <th scope="col">NOME</th>
                        <th scope="col">VALOR</th>
                        <th scope="col">VENCIMENTO</th>
                        <th scope="col">AÇÕES</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse($contas as $conta)
                        <tr class="text-center">
                            <td>{{ $conta->id }}</td>
                            <td>{{ $conta->nome }}</td>
                            <td>{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>
                            <td>{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</td>
                            <td class="text-center">
                                <a class="btn btn-primary btn-sm" href="{{ route('contas.show', ['conta' => $conta->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                                    </svg>
                                </a>
                                <a class="btn btn-warning btn-sm ms-2 me-2" href="{{ route('contas.edit', ['conta' => $conta->id]) }}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z"/>
                                    </svg>
                                </a>


                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#modalDelete" onclick="selecionarIdParaDeletar({{ $conta->id }})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                        <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5m-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5M4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06m6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528M8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5"/>
                                    </svg>
                                </button>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td  style="background-color: brown">Nenhuma conta encontrada</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>

                <div class="container text-center">
                    <div class="row">
                        <div class="col-auto me-auto"></div>
                        <div class="col-auto">{{ $contas->onEachSide(3)->links() }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <form class="d-inline">
            @csrf
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5">Excluir Conta</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="idSelecionado">
                        Deseja realmente excluir esta conta?
                    </div>
                    <div class="modal-footer">
                        <button type="button" onclick="deletarConta()" class="btn btn-success" data-bs-dismiss="modal">Sim</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Não</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        function selecionarIdParaDeletar(idSelecionado) {
            document.getElementById('idSelecionado').value = idSelecionado;
        }

        function deletarConta() {
            const baseUrl = '{{ url('') }}';
            const idParaDeletar = document.getElementById('idSelecionado').value;

            axios.delete(baseUrl+'/contas/destroy/'+idParaDeletar)
            .then(response => {
                const mensagemSucesso = document.getElementById('deleteSuccess');

                mostrarMensagem(mensagemSucesso, response.data.message);
            })
        }

        function mostrarMensagem(elementoHtml, mensagem) {
            elementoHtml.textContent = mensagem;
            elementoHtml.classList.remove('d-none');

            setTimeout(() => {
                elementoHtml.classList.add('d-none');
                window.location.reload();
            }, 1000)
        }
    </script>
@endsection
