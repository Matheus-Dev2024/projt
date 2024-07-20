<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Requests\ContaRequest;
use App\Models\Conta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ContasController extends Controller
{

    public function index(Request $request)
    {
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
                $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
                $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
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
        return view('contas.create');
    }

    public function store(ContaRequest $request)
    {

        $request->validated();

        try {

            $conta = Conta::create([
                'nome' => $request->nome,
                'valor' => str_replace(',', '.', str_replace('.', '', $request->valor)),
                'vencimento' => $request->vencimento,

            ]);

            return response()->json(['message' => 'Conta criada com sucesso!','conta' => $conta, ]);

        }catch (\Exception $e){

            Log::warning('CONTA NÃO CADASTRADA - '. $e->getMessage());

            return response()->json(['error' => 'Erro ao tentar salvar a conta! '.$e->getMessage()]);
        }
    }


    public function show(conta $conta)
    {

        return view('contas.show', ['conta' => $conta]);
    }


    public function edit(conta $conta)
    {
        return view('contas.edit', ['conta' => $conta]);
    }


    public function update(contaRequest $request, conta $conta)
    {
        $request->validated();
        try {
            $conta->update([
                'nome' => $request->nome,
                'valor' => str_replace(',', '.', str_replace('.', '', $request->valor)),
                'vencimento' => $request->vencimento,
            ]);

            Log::info('CONTA EDITADA COM SUCESSO', ['id' => $conta->id, 'conta' => $conta]);

            return redirect()->route('contas.edit', ['conta' => $conta->id ])->with('success', 'Conta alterada com sucesso!');

        }catch (\Exception $e){
            Log::warning('CONTA NÃO EDITADA');
            return back()->withInput()->with('ERRO', 'CONTA NÃO EDITADA');
        }

    }

    public function destroy(conta $conta)
    {

        $conta->delete();

//        return redirect()->route('contas.index')->with('success', 'Conta apagada com sucesso!');

        return response()->json(['message' => 'Conta apagada com sucesso!', 'conta' => $conta ]);
    }

    public function gerarpdf(request $request)
    {
        $contas = Conta::when($request->has('nome'), function ($whenQuery) use ($request) {
            $whenQuery->where('nome', 'like', '%' . $request->nome . '%');
        })
            ->when($request->filled('data_inicio'), function ($whenQuery) use ($request) {
                $whenQuery->where('vencimento', '>=', \Carbon\Carbon::parse($request->data_inicio)->format('Y-m-d'));
            })
            ->when($request->filled('data_fim'), function ($whenQuery) use ($request) {
                $whenQuery->where('vencimento', '<=', \Carbon\Carbon::parse($request->data_fim)->format('Y-m-d'));
            })
            ->orderBy('created_at',)
            ->get();


//
       $pdf = PDF::loadView('contas.gerar-pdf', ['contas' => $contas])->setPaper('a4', 'portrait');

       return $pdf->download('listar_contas.pdf');
    }


}
