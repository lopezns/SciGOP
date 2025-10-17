@extends('layouts.cafe')

@section('title', 'Nóminas')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold text-gray-900">Gestión de Nóminas</h2>
        <a href="{{ route('payroll.nominas.create') }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg flex items-center space-x-2">
            <span>💼</span>
            <span>Nueva Nómina</span>
        </a>
    </div>

    <!-- Payrolls Table -->
    <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Lista de Nóminas</h3>
        </div>

        @if($payrolls->count() > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Código</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Empleado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Período</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($payrolls as $payroll)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $payroll->payroll_code }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payroll->employee->full_name ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $payroll->period_description ?? 'N/A' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ucfirst($payroll->payroll_type) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            ${{ $payroll->formatted_net_salary ?? '0' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-{{ $payroll->status_color ?? 'gray' }}-100 text-{{ $payroll->status_color ?? 'gray' }}-800">
                                {{ $payroll->status_text ?? 'Desconocido' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <a href="{{ route('payroll.nominas.show', $payroll) }}" 
                               class="text-blue-600 hover:text-blue-900">Ver</a>
                            @if($payroll->status !== 'paid')
                            <a href="{{ route('payroll.nominas.edit', $payroll) }}" 
                               class="text-indigo-600 hover:text-indigo-900">Editar</a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $payrolls->links() }}
        </div>
        @else
        <div class="text-center py-12">
            <div class="text-gray-500">
                <span class="text-6xl">💼</span>
                <p class="mt-4 text-lg">No hay nóminas registradas</p>
                <p class="text-sm">Comienza creando tu primera nómina</p>
                <a href="{{ route('payroll.nominas.create') }}" 
                   class="mt-4 inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg">
                    Crear Primera Nómina
                </a>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection