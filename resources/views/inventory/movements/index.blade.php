<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-foreground leading-tight">Movimientos de Inventario</h2>
            <a href="{{ route('inventory.movements.create') }}" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Nuevo Movimiento</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-surface">
                <tr class="text-foreground/60 text-sm">
                    <th class="px-6 py-3 font-medium">Producto</th>
                    <th class="px-6 py-3 font-medium">Tipo</th>
                    <th class="px-6 py-3 font-medium">Cantidad</th>
                    <th class="px-6 py-3 font-medium">Usuario</th>
                    <th class="px-6 py-3 font-medium">Notas</th>
                    <th class="px-6 py-3 font-medium">Fecha</th>
                    @if(auth()->user()->isAdmin())
                    <th class="px-6 py-3 font-medium">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="divide-y divide-divider">
                @forelse($movements as $mov)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-foreground">{{ $mov->product->name }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-md {{ $mov->type === 'entry' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $mov->type === 'entry' ? 'Ingreso' : 'Egreso' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-foreground">{{ $mov->quantity }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->user->name }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->notes ?? '-' }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                    @if(auth()->user()->isAdmin())
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('inventory.movements.edit', $mov) }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium">Editar</a>
                        <form action="{{ route('inventory.movements.destroy', $mov) }}" method="POST" onsubmit="return confirm('¿Eliminar este movimiento?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger hover:text-rose-800 text-sm font-medium">Eliminar</button>
                        </form>
                    </td>
                    @endif
                </tr>
                @empty
                <tr><td colspan="7" class="px-6 py-12 text-center text-foreground/40">No hay movimientos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-divider">
            {{ $movements->links() }}
        </div>
    </div>
</x-app-layout>
