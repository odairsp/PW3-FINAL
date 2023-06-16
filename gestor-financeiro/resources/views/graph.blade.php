<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Gestor Financeiro') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex flex-row items-center">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <a href="{{route('transactions.index')}}">
                            {{ __('Transações') }}</a>
                    </div>

                    <div class="flex flex-row ">
                        <div class="p-6 flex flex-nowrap">
                            <form action="{{route('graphs.month')}}" method="POST">
                                @csrf

                                <label for="month"></label>
                                <input type="month" name="month" id="month" value="{{$dateMin}}">
                                <button type="submit"
                                    class="min-w-max shadow-black shadow-sm bg-green-700 hover:bg-green-900 text-white text-xs mx-1 py-2 px-3 rounded h-8 self-center">
                                    {{ __('Buscar') }}
                                </button>
                            </form>
                        </div>


                        <div class="p-6 flex flex-nowrap">
                            <a href="#"
                                class="min-w-max shadow-black shadow-sm bg-green-700 hover:bg-green-900 text-white text-xs mx-1 py-2 px-3 rounded h-8 self-center">
                                {{ __('Anual') }}
                            </a>
                        </div>

                    </div>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col  overflow-x-hidden">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-x-auto">

                                    <div>
                                        <canvas id="myChart" style="width: 100%; height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const ctx = document.getElementById('myChart');
        const timeElapsed = Date.now();
        const today = new Date(timeElapsed);
        const data = {
                labels: {{Js::from($label)}},
                datasets: [{
                    // label: today.toLocaleString('default', { month: 'long' }),
                    label: "Total por categorias",
                    data: {{Js::from($values)}},
                    backgroundColor: function(context) {
                        const value = context.dataset.data[context.dataIndex];
                        return value >= 0 ? 'blue' : 'red'; 
                        },
                    borderWidth: 1
                }]
            };
        const options = {
            scales: {
                x: {
                barThickness: 20, // Defina a largura das barras em pixels
                maxBarThickness: 25, // Defina a largura máxima das barras em pixels (opcional)
                minBarLength: 2 // Defina o comprimento mínimo das barras em pixels (opcional)
                },
                y: {
                beginAtZero: true
                }
            }
        };
            
        
        
        
        
        new Chart(ctx, {
            type: 'bar',
            data: data,
            options: options
            });
    </script>
</x-app-layout>