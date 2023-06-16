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
                        <a href="{{route('transactions.create')}}">
                            {{ __('Transações') }}</a>
                    </div>

                    <div class="flex flex-row ">
                        <div class="p-6 flex flex-nowrap">
                            <form action="{{route('graphs.month',5)}}" method="POST">
                                @csrf
                                
                                <select name="mes" id="mes">
                                    @for ($i = 1; $i < 12; $i++)
                                        
                                    @endfor
                                </select>
                                <input type="text" name="mes" id="">
                                <button type="submit"
                                    class="min-w-max shadow-black shadow-sm bg-green-700 hover:bg-green-900 text-white text-xs mx-1 py-2 px-3 rounded h-8 self-center">
                                    {{ __('Mês Atual') }}
                                </button>
                            </form>
                        </div>

                        <div class="p-6 flex flex-nowrap">
                            <a href="#"
                                class="min-w-max shadow-black shadow-sm bg-green-700 hover:bg-green-900 text-white text-xs mx-1 py-2 px-3 rounded h-8 self-center">
                                {{ __('Próximo Mês') }}
                            </a>
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
        const categorias =
            new Chart(ctx, {
                type: 'bar',
                data: {
                labels: {{Js::from($label)}},
                datasets: [{
                    label: today.toLocaleString('default', { month: 'long' }),
                    data: {{Js::from($values)}},
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });
    </script>
</x-app-layout>