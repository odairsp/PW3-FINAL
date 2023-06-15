<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor Financeiro') }}
        </h2>
    </x-slot>

    <h1>Registros</h1>
    <form method="GET" action="{{ route('graphs.index') }}">
        <label for="categoria">Filtrar por categoria:</label>
        <select id="categoria" name="categoria">
            <option value="todas">Todas as categorias</option>
            <option value="Categoria A" {{ $categoria==='Categoria A' ? 'selected' : '' }}>Categoria A</option>
            <option value="Categoria B" {{ $categoria==='Categoria B' ? 'selected' : '' }}>Categoria B</option>
            <option value="Categoria C" {{ $categoria==='Categoria C' ? 'selected' : '' }}>Categoria C</option>
        </select>
        <button type="submit">Filtrar</button>
    </form>
    <div id="grafico"></div>
    <table>
        <thead>
            <tr>
                <th>Categoria</th>
                <th>Valor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
            <tr>
                <td>{{ $registro->categoria }}</td>
                <td>{{ $registro->valor }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <script>
        const dados = {!! json_encode($registros) !!};

        const categorias = [...new Set(dados.map(dado => dado.categoria))];
        const valores = categorias.map(categoria => dados.filter(dado => dado.categoria === categoria).reduce((acc, cur) => acc + cur.valor, 0));

        Highcharts.chart('grafico', {
            chart: {
                type: 'pie'
            },
            title: {
                text: 'Categorias de registros'
            },
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    }
                }
            },
            series: [{
                name: 'Categorias',
                data: categorias.map((categoria, i) => ({
                    name: categoria,
                    y: valores[i]
                }))
            }]
        });
    </script>
</x-app-layout>