@extends('layouts.admin')

@section('desing')
    <div class="container mt-3">
        @include('components.alert')

        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    <h4>EDITAR CONTA</h4>
                </span>
                <span>
                    <a class="btn btn-warning btn-sm me-1" href="{{ route('contas.index') }}">Voltar</a>
                    <a class="btn btn-primary btn-sm" href="{{ route('contas.show', ['conta' => $conta->id]) }}">Visualizar</a>
                </span>
            </div>
            <div class="card-body">
                <form action="{{ route('contas.update', ['conta' => $conta->id]) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')

                    <div class="col-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="NOME DA CONTA" value="{{ old('nome', $conta->nome) }}">
                    </div>

                    <div class="col-12">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control" id="valor" placeholder="VALOR DA CONTA" value="{{ old('valor', isset($conta->valor) ? number_format($conta->valor, 2, ',', '.') : '') }}">
                    </div>

                    <div class="col-12">
                        <label for="vencimento" class="form-label">Vencimento</label>
                        <input type="date" name="vencimento" class="form-control" id="vencimento" placeholder="VENCIMENTO DA CONTA" value="{{ old('vencimento', $conta->vencimento) }}">
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-warning btn-sm">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
