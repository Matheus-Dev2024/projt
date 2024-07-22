<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use App\Models\SituacaoConta;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class ContasController extends Controller
{
    public function index(Request $request)
    {
        $contas = Conta::when($request->has('nome'), function ($query) use ($request) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('data_inicio'), function ($query) use ($request) {
                $query->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($query) use ($request) {
                $query->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->with('situacaoConta')
            ->orderBy('created_at', 'DESC')
            ->paginate(10)
            ->withQueryString();



        return view('contas.index', [
            'contas' => $contas,
            'nome' => $request->nome,
            'data_inicio' => $request->data_inicio,
            'data_fim' => $request->data_fim
        ]);
    }

    public function create()
    {
        $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();

        return view('contas.create', [
            'situacoesContas' => $situacoesContas
        ]);
    }

    public function store(ContaRequest $request)
    {
        try {
            $validated = $request->validated();

            $conta = Conta::create([
                'nome' => $validated['nome'],
                'valor' => str_replace(',', '.', str_replace('.', '', $validated['valor'])),
                'vencimento' => $validated['vencimento'],
                'situacao_conta_id' => $validated['situacao_conta_id'],
            ]);

            return redirect()->route('contas.show', ['conta' => $conta->id])->with('success', 'Conta cadastrada com sucesso!');
        } catch (\Exception $e) {
            Log::error('CONTA NÃO CADASTRADA - ' . $e->getMessage());
            return back()->withInput()->with('error', 'Erro ao cadastrar conta.');
        }
    }

    public function show(Conta $conta)
    {
        return view('contas.show', ['conta' => $conta]);
    }

    public function edit(Conta $conta)
    {
        $situacoesContas = SituacaoConta::orderBy('nome', 'asc')->get();
        return view('contas.edit', ['conta' => $conta, 'situacoesContas' => $situacoesContas]);
    }

    public function update(ContaRequest $request, Conta $conta)
    {
        try {
            $validated = $request->validated();

            $conta->update([
                'nome' => $validated['nome'],
                'valor' => str_replace(',', '.', str_replace('.', '', $validated['valor'])),
                'vencimento' => $validated['vencimento'],
                'situacao_conta_id' => $validated['situacao_conta_id'],
            ]);

            Log::info('CONTA EDITADA COM SUCESSO', ['id' => $conta->id, 'conta' => $conta]);

            return redirect()->route('contas.edit', ['conta' => $conta->id])->with('success', 'Conta alterada com sucesso!');

        } catch (\Exception $e) {

            Log::error('CONTA NÃO EDITADA - ' . $e->getMessage());

            return back()->withInput()->with('error', 'Erro ao editar conta.');
        }
    }

    public function destroy(Conta $conta)
    {
        try {
            $conta->delete();
            return redirect()->route('contas.index')->with('success', 'Conta apagada com sucesso!');
        } catch (\Exception $e) {
            Log::error('CONTA NÃO APAGADA - ' . $e->getMessage());
            return back()->with('error', 'Erro ao apagar conta.');
        }
    }

    public function gerarPDF(Request $request)
    {
        $contas = Conta::when($request->has('nome'), function ($query) use ($request) {
            $query->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('data_inicio'), function ($query) use ($request) {
                $query->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($query) use ($request) {
                $query->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->orderBy('created_at')
            ->get();

        $totalValor = $contas->sum('valor');

        $pdf = PDF::loadView('contas.gerar-pdf', ['contas' => $contas, 'totalValor' => $totalValor])->setPaper('a4', 'portrait');

        return $pdf->download('listar_contas.pdf');
    }
}
