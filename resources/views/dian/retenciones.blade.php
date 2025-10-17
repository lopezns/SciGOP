@extends('layouts.cafe')

@section('title', 'DIAN - Retenciones en la Fuente')

@section('content')
<div class="space-y-6">
    <!-- Header -->
    <div class="flex justify-between items-center">
        <div>
            <h2 class="text-2xl font-bold text-gray-900">Retenciones en la Fuente</h2>
            <p class="text-gray-600 mt-1">Control y gestión de retenciones aplicadas a empleados y terceros</p>
        </div>
        <a href="{{ route('dian.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg">
            ← Volver al Dashboard DIAN
        </a>
    </div>

    <!-- Monthly Summary -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-amber-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-blue-600 text-2xl">👥</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Empleados con Retención</h3>
                    <p class="text-2xl font-bold text-blue-600">{{ $stats['total_employees'] ?? 0 }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-amber-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-green-600 text-2xl">💰</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Total Retenido (Mes)</h3>
                    <p class="text-2xl font-bold text-green-600">${{ number_format($stats['total_withholdings'] ?? 0, 0, ',', '.') }}</p>
                    <p class="text-xs text-gray-500">COP</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-amber-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-purple-600 text-2xl">📊</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Tasa Promedio</h3>
                    <p class="text-2xl font-bold text-purple-600">{{ number_format($stats['avg_rate'] ?? 0, 2) }}%</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-amber-200">
            <div class="flex items-center">
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                    <span class="text-red-600 text-2xl">⏰</span>
                </div>
                <div>
                    <h3 class="text-sm text-gray-600">Pagos Pendientes</h3>
                    <p class="text-2xl font-bold text-red-600">{{ $stats['pending_payments'] ?? 0 }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Withholding Rates Table -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-800 text-white">
                <h3 class="text-lg font-medium flex items-center">
                    <span class="text-2xl mr-2">🧮</span>
                    Tarifas de Retención Vigentes
                </h3>
            </div>
            <div class="p-6">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Concepto</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Código</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Tarifa</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">UVT</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse($retentionRates ?? [] as $rate)
                            <tr>
                                <td class="px-4 py-3 font-medium text-gray-900">{{ $rate['concept'] ?? 'N/A' }}</td>
                                <td class="px-4 py-3"><span class="bg-gray-200 text-gray-800 px-2 py-1 rounded text-xs">{{ $rate['code'] ?? 'N/A' }}</span></td>
                                <td class="px-4 py-3 text-gray-900">{{ $rate['rate'] ?? '0' }}%</td>
                                <td class="px-4 py-3 text-gray-900">{{ $rate['uvt_threshold'] ?? 'N/A' }}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="px-4 py-8 text-center text-gray-500">
                                    <span class="text-2xl">📋</span>
                                    <p class="mt-2">No hay tarifas de retención configuradas</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-blue-50">
                <h3 class="text-lg font-medium text-blue-900 flex items-center">
                    <span class="text-2xl mr-2">💰</span>
                    Información UVT 2024
                </h3>
            </div>
            <div class="p-6">
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <h4 class="font-semibold text-blue-900 mb-2 flex items-center">
                        <span class="mr-2">🪙</span>
                        Valor UVT 2024
                    </h4>
                    <p class="text-2xl font-bold text-blue-600 mb-2">COP 47,065</p>
                    <p class="text-sm text-blue-700">Resolución 000013 del 09 de Febrero de 2024</p>
                </div>
                
                <h4 class="font-semibold text-gray-900 mb-3">Rangos de Retención por Salarios:</h4>
                <div class="space-y-2">
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded">
                        <span>0 - 95 UVT</span>
                        <span class="bg-green-100 text-green-800 px-2 py-1 rounded text-sm font-medium">0%</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded">
                        <span>95 - 150 UVT</span>
                        <span class="bg-yellow-100 text-yellow-800 px-2 py-1 rounded text-sm font-medium">19%</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded">
                        <span>150 - 360 UVT</span>
                        <span class="bg-orange-100 text-orange-800 px-2 py-1 rounded text-sm font-medium">28%</span>
                    </div>
                    <div class="flex justify-between items-center p-3 border border-gray-200 rounded">
                        <span>Más de 360 UVT</span>
                        <span class="bg-red-100 text-red-800 px-2 py-1 rounded text-sm font-medium">33%</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Employee Withholdings Detail -->
    <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex justify-between items-center">
                <h3 class="text-lg font-medium text-gray-900 flex items-center">
                    <span class="text-2xl mr-2">📄</span>
                    Detalle de Retenciones por Empleado ({{ date('F Y') }})
                </h3>
                <button class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm flex items-center space-x-2" onclick="exportToExcel()">
                    <span>📈</span>
                    <span>Exportar Excel</span>
                </button>
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-800 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Empleado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Documento</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Salario Base</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Base Retención</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">% Aplicado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Valor Retenido</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Acciones</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($employeeWithholdings ?? [] as $withholding)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <span class="text-blue-600 font-medium text-sm">
                                        {{ strtoupper(substr($withholding['name'] ?? 'N', 0, 1)) }}
                                    </span>
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $withholding['name'] ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500">{{ $withholding['position'] ?? 'N/A' }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $withholding['document'] ?? 'N/A' }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($withholding['base_salary'] ?? 0, 0, ',', '.') }} COP</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">${{ number_format($withholding['retention_base'] ?? 0, 0, ',', '.') }} COP</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded text-xs font-medium">{{ $withholding['rate'] ?? '0' }}%</span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-green-600">
                            ${{ number_format($withholding['withheld_amount'] ?? 0, 0, ',', '.') }} COP
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($withholding['status'] ?? '') === 'Pagado' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                {{ $withholding['status'] ?? 'Pendiente' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                            <button class="text-blue-600 hover:text-blue-900" title="Ver Certificado" onclick="viewCertificate({{ $withholding['employee_id'] ?? 0 }})">
                                📜 Ver
                            </button>
                            <button class="text-red-600 hover:text-red-900" title="Generar PDF" onclick="generatePDF({{ $withholding['employee_id'] ?? 0 }})">
                                📄 PDF
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            <span class="text-6xl">📄</span>
                            <p class="mt-4 text-lg">No hay retenciones registradas</p>
                            <p class="text-sm">Las retenciones se generarán automáticamente con las nóminas procesadas</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
                @if(isset($employeeWithholdings) && count($employeeWithholdings) > 0)
                <tfoot class="bg-gray-100">
                    <tr>
                        <th colspan="5" class="px-6 py-3 text-right text-sm font-medium text-gray-900">TOTAL RETENCIONES:</th>
                        <th class="px-6 py-3 text-sm font-bold text-green-600">
                            ${{ number_format(collect($employeeWithholdings)->sum('withheld_amount'), 0, ',', '.') }} COP
                        </th>
                        <th colspan="2"></th>
                    </tr>
                </tfoot>
                @endif
            </table>
        </div>
        </div>
    </div>

    <!-- Payment Schedule y Herramientas -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Cronograma de Pagos -->
        <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-gray-600 text-white">
                <h3 class="text-lg font-medium flex items-center">
                    <span class="text-2xl mr-2">📅</span>
                    Cronograma de Pagos - Retención en la Fuente
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    @forelse($paymentSchedule ?? [] as $payment)
                    <div class="border-l-4 {{ ($payment['status'] ?? '') === 'Completado' ? 'border-green-500 bg-green-50' : (($payment['status'] ?? '') === 'Pendiente' ? 'border-yellow-500 bg-yellow-50' : 'border-gray-500 bg-gray-50') }} rounded-r-lg p-4">
                        <div class="flex justify-between items-start">
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900">{{ $payment['period'] ?? 'N/A' }}</h4>
                                <p class="text-gray-600 text-sm mb-2">{{ $payment['description'] ?? 'N/A' }}</p>
                                <div class="flex justify-between items-center">
                                    <span class="text-blue-600 font-medium">${{ number_format($payment['amount'] ?? 0, 0, ',', '.') }} COP</span>
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ ($payment['status'] ?? '') === 'Completado' ? 'bg-green-100 text-green-800' : (($payment['status'] ?? '') === 'Pendiente' ? 'bg-yellow-100 text-yellow-800' : 'bg-gray-100 text-gray-800') }}">
                                        {{ $payment['status'] ?? 'Sin estado' }}
                                    </span>
                                </div>
                                <p class="text-xs text-gray-500 mt-1">Fecha límite: {{ $payment['due_date'] ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="text-center py-8 text-gray-500">
                        <span class="text-4xl">📅</span>
                        <p class="mt-2">No hay cronograma de pagos disponible</p>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Herramientas -->
        <div class="bg-white rounded-xl shadow-sm border border-amber-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-gray-200 bg-blue-600 text-white">
                <h3 class="text-lg font-medium flex items-center">
                    <span class="text-2xl mr-2">🔧</span>
                    Herramientas
                </h3>
            </div>
            <div class="p-6">
                <div class="space-y-3">
                    <button class="w-full bg-gray-800 hover:bg-gray-900 text-white px-4 py-2 rounded-lg flex items-center space-x-2" onclick="calculateWithholdings()">
                        <span>🧮</span>
                        <span>Calcular Retenciones</span>
                    </button>
                    <button class="w-full border border-gray-800 text-gray-800 hover:bg-gray-50 px-4 py-2 rounded-lg flex items-center space-x-2" onclick="generateFormats()">
                        <span>📄</span>
                        <span>Generar Formatos</span>
                    </button>
                    <button class="w-full border border-gray-800 text-gray-800 hover:bg-gray-50 px-4 py-2 rounded-lg flex items-center space-x-2" onclick="uploadThirdParties()">
                        <span>📂</span>
                        <span>Cargar Terceros</span>
                    </button>
                    <button class="w-full border border-gray-800 text-gray-800 hover:bg-gray-50 px-4 py-2 rounded-lg flex items-center space-x-2" onclick="validatePayments()">
                        <span>✓</span>
                        <span>Validar Pagos</span>
                    </button>
                </div>
                
                <hr class="my-6">
                
                <h4 class="font-semibold text-gray-900 mb-3">Enlaces Rápidos:</h4>
                <div class="space-y-2">
                    <a href="{{ route('dian.declaraciones') }}" class="block w-full p-3 border border-gray-200 rounded-lg hover:bg-gray-50 flex items-center space-x-2">
                        <span>📄</span>
                        <span>Declaraciones</span>
                    </a>
                    <a href="{{ route('dian.certificacion') }}" class="block w-full p-3 border border-gray-200 rounded-lg hover:bg-gray-50 flex items-center space-x-2">
                        <span>📜</span>
                        <span>Certificados</span>
                    </a>
                    <a href="{{ route('payroll.dashboard') }}" class="block w-full p-3 border border-gray-200 rounded-lg hover:bg-gray-50 flex items-center space-x-2">
                        <span>📈</span>
                        <span>Dashboard Nómina</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function viewCertificate(employeeId) {
    // Redirect to certificate view
    window.location.href = `{{ route('dian.certificacion') }}?employee=${employeeId}`;
}

function generatePDF(employeeId) {
    // Generate PDF for specific employee
    window.open(`{{ route('reports.payroll.pdf') }}?employee=${employeeId}`, '_blank');
}

function exportToExcel() {
    // Export current withholdings to Excel
    alert('Función de exportación a Excel en desarrollo');
}

function calculateWithholdings() {
    alert('Calculadora de retenciones en desarrollo');
}

function generateFormats() {
    alert('Generador de formatos en desarrollo');
}

function uploadThirdParties() {
    alert('Carga de terceros en desarrollo');
}

function validatePayments() {
    alert('Validador de pagos en desarrollo');
}
</script>

@endsection