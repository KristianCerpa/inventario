<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-foreground leading-tight">{{ $product->name }}</h2>
            <a href="{{ route('products.index') }}" class="text-foreground/60 hover:text-foreground text-sm font-medium">Volver</a>
        </div>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
        <div class="bg-white rounded-xl shadow-sm border border-divider p-6">
            <h3 class="text-lg font-semibold text-foreground mb-4">Detalles</h3>
            <dl class="space-y-3">
                <div class="flex justify-between border-b border-divider pb-2"><dt class="text-foreground/60">Nombre</dt><dd class="font-medium text-foreground">{{ $product->name }}</dd></div>
                <div class="flex justify-between border-b border-divider pb-2"><dt class="text-foreground/60">Categoría</dt><dd class="text-foreground">{{ $product->category }}</dd></div>
                <div class="flex justify-between border-b border-divider pb-2"><dt class="text-foreground/60">Precio</dt><dd class="text-foreground">${{ number_format($product->price, 2) }}</dd></div>
                <div class="flex justify-between border-b border-divider pb-2"><dt class="text-foreground/60">Stock</dt><dd class="text-foreground">{{ $product->stock }}</dd></div>
                <div class="flex justify-between pb-2"><dt class="text-foreground/60">Creado</dt><dd class="text-foreground">{{ $product->created_at->format('d/m/Y H:i') }}</dd></div>
            </dl>
        </div>
    </div>

    <div class="bg-white rounded-xl shadow-sm border border-divider overflow-hidden">
        <div class="px-6 py-4 border-b border-divider"><h3 class="text-lg font-semibold text-foreground">Movimientos</h3></div>
        <table class="w-full text-left">
            <thead class="bg-surface">
                <tr class="text-foreground/60 text-sm">
                    <th class="px-6 py-3 font-medium">Tipo</th>
                    <th class="px-6 py-3 font-medium">Cantidad</th>
                    <th class="px-6 py-3 font-medium">Usuario</th>
                    <th class="px-6 py-3 font-medium">Notas</th>
                    <th class="px-6 py-3 font-medium">Fecha</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-divider">
                @forelse($product->movements as $mov)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-md {{ $mov->type === 'entry' ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $mov->type === 'entry' ? 'Ingreso' : 'Egreso' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-foreground">{{ $mov->quantity }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->user->name }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->notes ?? '-' }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $mov->created_at->format('d/m/Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-8 text-center text-foreground/40">Sin movimientos.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
