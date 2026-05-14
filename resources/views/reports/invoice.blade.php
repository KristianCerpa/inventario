<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">Generar Reporte PDF</h2>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider p-6 max-w-lg">
        <form action="{{ route('reports.invoice.pdf') }}" method="GET" target="_blank">
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Periodo</label>
                <select name="period" id="period" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20" onchange="toggleDateField()">
                    <option value="day">Día</option>
                    <option value="month">Mes</option>
                    <option value="year">Año</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Fecha</label>
                <input type="date" name="date" id="date" value="{{ date('Y-m-d') }}" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-danger hover:bg-rose-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    Generar PDF
                </button>
                <a href="{{ route('dashboard') }}" class="bg-white border border-divider hover:bg-surface text-foreground/80 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Cancelar</a>
            </div>
        </form>
    </div>

    <script>
        function toggleDateField() {
            const period = document.getElementById('period').value;
            const dateInput = document.getElementById('date');
            if (period === 'year') {
                dateInput.type = 'number';
                dateInput.min = '2000';
                dateInput.max = '2100';
                dateInput.value = '{{ date("Y") }}';
                dateInput.step = '1';
            } else {
                dateInput.type = 'date';
                dateInput.value = '{{ date("Y-m-d") }}';
            }
        }
    </script>
</x-app-layout>
