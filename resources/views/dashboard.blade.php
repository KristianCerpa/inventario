<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">Dashboard</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-divider p-6">
            <div class="flex items-center">
                <div class="p-3 bg-indigo-50 rounded-lg">
                    <svg class="w-8 h-8 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-foreground/60">Total Productos</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-divider p-6">
            <div class="flex items-center">
                <div class="p-3 bg-emerald-50 rounded-lg">
                    <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-foreground/60">Total Ingresos</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalEntries }}</p>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-divider p-6">
            <div class="flex items-center">
                <div class="p-3 bg-rose-50 rounded-lg">
                    <svg class="w-8 h-8 text-danger" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 17h8m0 0V9m0 8l-8-8-4 4-6-6"/></svg>
                </div>
                <div class="ml-4">
                    <p class="text-sm text-foreground/60">Total Egresos</p>
                    <p class="text-2xl font-bold text-foreground">{{ $totalExits }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-divider">
        <div class="px-6 py-4 border-b border-divider">
            <h3 class="text-lg font-semibold text-foreground">Movimientos Recientes</h3>
        </div>
        <div class="p-6">
            @if($recentMovements->count())
            <table class="w-full text-left">
                <thead>
                    <tr class="text-foreground/60 text-sm border-b border-divider">
                        <th class="pb-3 font-medium">Producto</th>
                        <th class="pb-3 font-medium">Tipo</th>
                        <th class="pb-3 font-medium">Cantidad</th>
                        <th class="pb-3 font-medium">Usuario</th>
                        <th class="pb-3 font-medium">Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentMovements as $mov)
                    <tr class="border-b border-divider last:border-0">
                        <td class="py-3 text-foreground">{{ $mov->product->name }}</td>
                        <td class="py-3">
                            <span class="px-2 py-1 text-xs font-medium rounded-md {{ $mov->type === 'entry' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                                {{ $mov->type === 'entry' ? 'Ingreso' : 'Egreso' }}
                            </span>
                        </td>
                        <td class="py-3 text-foreground">{{ $mov->quantity }}</td>
                        <td class="py-3 text-foreground/60">{{ $mov->user->name }}</td>
                        <td class="py-3 text-foreground/60">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
            <p class="text-foreground/40 text-center py-4">No hay movimientos registrados.</p>
            @endif
        </div>
    </div>
</x-app-layout>
