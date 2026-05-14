<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-foreground leading-tight">Stock de Productos</h2>
            <div class="flex gap-2">
                <form method="GET" class="flex gap-2">
                    <input type="text" name="search" placeholder="Buscar producto..." value="{{ $search ?? '' }}" class="border-divider rounded-lg text-sm shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                    <button type="submit" class="bg-foreground/80 hover:bg-foreground text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">Buscar</button>
                </form>
                <a href="{{ route('inventory.stock', ['sort' => $sort === 'desc' ? 'asc' : 'desc']) }}" class="bg-white border border-divider hover:bg-surface text-foreground/80 px-3 py-2 rounded-lg text-sm font-medium transition-colors flex items-center gap-1">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4h13M3 8h9m-9 4h6m4 0l4-4m0 0l4 4m-4-4v12"/></svg>
                    {{ $sort === 'desc' ? 'Más recientes' : 'Más antiguos' }}
                </a>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-surface">
                <tr class="text-foreground/60 text-sm">
                    <th class="px-6 py-3 font-medium">Producto</th>
                    <th class="px-6 py-3 font-medium">Categoría</th>
                    <th class="px-6 py-3 font-medium">Precio</th>
                    <th class="px-6 py-3 font-medium">Stock Actual</th>
                    <th class="px-6 py-3 font-medium">Fecha Registro</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-divider">
                @forelse($products as $product)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-foreground">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $product->category }}</td>
                    <td class="px-6 py-4 text-foreground">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-md {{ $product->stock > 10 ? 'bg-emerald-50 text-emerald-700' : ($product->stock > 0 ? 'bg-amber-50 text-amber-700' : 'bg-rose-50 text-rose-700') }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-foreground/60">{{ $product->created_at->format('d/m/Y') }}</td>
                </tr>
                @empty
                <tr><td colspan="5" class="px-6 py-12 text-center text-foreground/40">No hay productos.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-divider">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
