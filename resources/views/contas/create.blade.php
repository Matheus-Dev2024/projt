@extends('layouts.admin')

@section('desing')
    <div class="container mt-3">
        <x-alert />
        @include('components.alert')
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
                <form id="formConta" action="{{ route('contas.store') }}" method="POST" class="row g-3">
                    @csrf
                    <div class="col-md-12 col-sm-12">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" name="nome" class="form-control" id="nome" placeholder="NOME DA CONTA" value="{{ old('nome') }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="valor" class="form-label">Valor</label>
                        <input type="text" name="valor" class="form-control" id="valor" placeholder="VALOR DA CONTA" value="{{ old('valor') }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="vencimento" class="form-label">Vencimento</label>
                        <input type="date" name="vencimento" class="form-control" id="vencimento" placeholder="VENCIMENTO DA CONTA" value="{{ old('vencimento') }}">
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <label for="situacao_conta_id" class="form-label">Situação da Conta</label>
                        <select id="situacao_conta_id" class="form-select select2" name="situacao_conta_id">
                            @forelse($situacoesContas as $situacaoConta)
                                <option value="{{ $situacaoConta->id }}" {{ old('situacao_conta_id') == $situacaoConta->id ? 'selected' : '' }}>
                                    {{ $situacaoConta->nome }}
                                </option>
                            @empty
                                <option value="">Nenhuma situação da conta encontrada</option>
                            @endforelse
                        </select>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <button type="submit" class="btn btn-success btn-sm">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
