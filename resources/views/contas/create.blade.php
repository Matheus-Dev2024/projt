@extends('layouts.admin')

@section('desing')

    <div class="container mt-3">

        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </div>
        @endif

        <div id="msgError" class="alert alert-danger d-none"></div>
        <div id="msgSuccess" class="alert alert-success d-none"></div>


        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    <h4>CADASTRAR CONTA</h4>
                </span>
                <span>
                    <a class="btn btn-warning btn-sm me-1" href="{{ route('contas.index') }}">Voltar</a>

                </span>
            </div>
            <div class="card-body">
                <form id="formConta" action="{{ route('contas.store') }}" onsubmit="salvarConta(event)" method="POST" class="row g-3">
                    @csrf


                    <div class="col-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="NOME DA CONTA" value="{{ old('nome') }}">
                    </div>

                    <div class="col-12">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control" id="valor" placeholder="VALOR DA CONTA" value="{{ old('valor') }}">
                    </div>

                    <div class="col-12">
                        <label for="vencimento" class="form-label">Vencimento</label>
                        <input type="date" name="vencimento" class="form-control" id="vencimento" placeholder="VENCIMENTO DA CONTA" value="{{ old('vencimento') }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>

        function salvarConta(event) {
            event.preventDefault(); //cancelando o evento padrão do submit

            const formulario = document.getElementById('formConta');
            const msgSuccess = document.getElementById('msgSuccess');
            const msgError = document.getElementById('msgError');

            const baseUrl = '{{ url('') }}';

            axios.post('{{ route('contas.store') }}', formulario)
                .then(response => {
                    if(response.data.error) {
                        mostrarMensagem(msgError, response.data.error);
                    }
                    else {
                        mostrarMensagem(msgSuccess, response.data.message);

                        setTimeout(() => {
                            window.location = baseUrl+'/contas/show/'+response.data.conta.id;
                        },1000)
                    }
                })
        }

        function mostrarMensagem(elementoHtml, mensagem) {
            elementoHtml.textContent = mensagem;
            elementoHtml.classList.remove('d-none');

            setTimeout(() => {
                elementoHtml.classList.add('d-none');
            }, 1000)

        }
    </script>
@endsection
