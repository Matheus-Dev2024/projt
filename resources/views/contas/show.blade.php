@extends('layouts.admin')

@section('desing')
    <div class="container mt-3">
        <div class="card mt-4 mb-4 border-light shadow">
            <div class="card-header d-flex justify-content-between">
                <span>
                    <h4> Lista de Contas </h4>
                </span>
                <span>
                    <a class="btn btn-warning btn-sm me-1" href="{{ route('contas.edit', ['conta' => $conta->id]) }}">Editar</a>
                    <a class="btn btn-info btn-sm" href="{{ route('contas.index') }}">Listar</a>
                </span>
            </div>

            <script>

                @if(session()->has('success'))
                document.addEventListener('DOMContentLoaded', () => {
                        Swal.fire({
                            title: 'Pronto!',
                            text: "{{ session('success') }}",
                            icon: 'success',
                            timer: 2000,
                            showConfirmButton: false
                        });
                    });

            @endif

            </script>

            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">NOME</dt>
                    <dd class="col-sm-9">{{ $conta->nome }}</dd>

                    <dt class="col-sm-3">VALOR</dt>
                    <dd class="col-sm-9">{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</dd>

                    <dt class="col-sm-3">VENCIMENTO</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y') }}</dd>

                    <dt class="col-sm-3">SITUAÇÃO</dt>
                    <dd class="col-sm-9">{!! '<span class="badge text-bg-'.$conta->situacaoConta->cor.'">'.$conta->situacaoConta->nome.'</span>' !!}</dd>

                    <dt class="col-sm-3">CADASTRADO</dt>
                    <dd class="col-sm-9">{{\Carbon\Carbon::parse($conta->create_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>

                    <dt class="col-sm-3">EDITADO</dt>
                    <dd class="col-sm-9">{{\Carbon\Carbon::parse($conta->updated_at)->tz('America/Sao_Paulo')->format('d/m/Y H:i:s') }}</dd>
                </dl>
            </div>
        </div>
    </div>
@endsection
