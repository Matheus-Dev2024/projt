<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>contas</title>

</head>
<body style="font-size: 12px">

    <h2 style="text-align: center">contas</h2>

    <table style="border-collapse:collapse; width: 100%; background-color: #ffffff" >
        <thead>
        <tr  style="text-align: center; background-color: #a2a2a2" >
            <th>ID</th>
            <th >NOME</th>
            <th >VENCIMENTO</th>
            <th>VALOR</th>

        </tr>
        </thead>
        <tbody>
        @forelse($contas as $conta)
            <tr style="text-align: center; border: none" >
                <td style="border: 1px solid #ccc;">{{ $conta->id }}</td>
                <td style="border: 1px solid #ccc;">{{ $conta->nome }}</td>
                <td style="border: 1px solid #ccc;">{{ \Carbon\Carbon::parse($conta->vencimento)->tz('America/Sao_Paulo')->format('d/m/Y')}}</td>
                <td style="border: 1px solid #ccc; ">{{ 'R$ ' . number_format($conta->valor, 2, ',', '.') }}</td>

            </tr>
        @empty
            <tr>
                <td  style="background-color: brown">Nenhuma conta encontrada</td>
            </tr>
        @endforelse

            <tr>
                <td colspan="3" style="border: 1px solid #ccc; text-align: center;">Total</td>
                <td style="border: 1px solid #ccc; text-align: center;">{{ 'R$' . number_format($totalValor, 2, ',', '.') }}</td>
            </tr>

        </tbody>
    </table>



</body>
</html>
