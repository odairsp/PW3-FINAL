<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Nova Transação') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="grid grid-cols-6 gap-4">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        {{ __('Transações') }}

                    </div>
                    <div class="flex">

                        <a href="{{route('categories.create')}}"
                            class="min-w-max shadow-black shadow-sm bg-green-700 hover:bg-green-900 text-white text-xs mx-1 py-2 px-3 rounded h-8 self-center">
                            {{ __('Nova Categoria') }}
                        </a>

                    </div>
                </div>
                @if (session('msg'))
                <div class="bg-green-300 text-white font-bold text-center">{{session('msg')}}</div>
                @endif

                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex flex-col  overflow-x-hidden">
                        <div class="sm:-mx-6 lg:-mx-8">
                            <div class="inline-block min-w-full py-2 sm:px-6 lg:px-8">
                                <div class="overflow-x-auto">

                                    <table class=" min-w-full text-left text-sm font-light">
                                        <thead class="border-b font-medium dark:border-neutral-500">
                                            <tr class="bg-slate-200">
                                                <th scope="col" class="px-6 py-4">Categoria</th>
                                                <th scope="col" class="px-6 py-4">Nome</th>
                                                <th scope="col" class="px-6 py-4">Valor</th>
                                                <th scope="col" class="px-6 py-4">Data</th>
                                                <th scope="col" class="px-7 py-4">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="border-b dark:border-neutral-500 hover:bg-neutral-100">
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <select name="" id="">
                                                        @foreach ($categories as $category)
                                                        <option value="{{$category->id}}">{{$category->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <input type="text" name="" id="">
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <input type="text" name="" id="">
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <input type="date" name="" id="">
                                                </td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div>
                                                        <button
                                                            class="shadow-black shadow-sm bg-red-700 hover:bg-red-900 text-white text-xs mx-1 py-2 px-3 rounded">
                                                            Salvar
                                                        </button>
                                                        <button
                                                            class="shadow-black shadow-sm bg-red-700 hover:bg-red-900 text-white text-xs mx-1 py-2 px-3 rounded">
                                                            Cancelar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tbody>
                                            @foreach ($transactions as $transaction)
                                            <tr class="border-b dark:border-neutral-500 hover:bg-neutral-100">
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ $transaction->category->name }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">{{ $transaction->name }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ str_replace('.', ',', $transaction->value) }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    {{ date('d/m/Y', strtotime($transaction->date)) }}</td>
                                                <td class="whitespace-nowrap px-6 py-4">
                                                    <div class="inline-flex ">
                                                        <form action="}" method="GET">
                                                            @csrf
                                                            <button type="submit"
                                                                class="shadow-black shadow-sm bg-yellow-600 hover:bg-yellow-800 text-white text-xs mx-1 py-2 px-3 rounded">
                                                                Editar
                                                            </button>
                                                        </form>
                                                        <button
                                                            class="shadow-black shadow-sm bg-red-700 hover:bg-red-900 text-white text-xs mx-1 py-2 px-3 rounded">
                                                            Deletar
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>