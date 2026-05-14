<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-foreground leading-tight">Productos</h2>
            <a href="{{ route('products.create') }}" class="bg-primary hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Nuevo Producto</a>
        </div>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider overflow-hidden">
        <table class="w-full text-left">
            <thead class="bg-surface">
                <tr class="text-foreground/60 text-sm">
                    <th class="px-6 py-3 font-medium">Nombre</th>
                    <th class="px-6 py-3 font-medium">Categoría</th>
                    <th class="px-6 py-3 font-medium">Precio</th>
                    <th class="px-6 py-3 font-medium">Stock</th>
                    <th class="px-6 py-3 font-medium">Creado</th>
                    <th class="px-6 py-3 font-medium">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-divider">
                @forelse($products as $product)
                <tr class="hover:bg-surface/50 transition-colors">
                    <td class="px-6 py-4 font-medium text-foreground">{{ $product->name }}</td>
                    <td class="px-6 py-4 text-foreground/60">{{ $product->category }}</td>
                    <td class="px-6 py-4 text-foreground">${{ number_format($product->price, 2) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs font-medium rounded-md {{ $product->stock > 0 ? 'bg-emerald-50 text-emerald-700' : 'bg-rose-50 text-rose-700' }}">
                            {{ $product->stock }}
                        </span>
                    </td>
                    <td class="px-6 py-4 text-foreground/60">{{ $product->created_at->format('d/m/Y') }}</td>
                    <td class="px-6 py-4 flex gap-2">
                        <a href="{{ route('products.show', $product) }}" class="text-primary hover:text-indigo-800 text-sm font-medium">Ver</a>
                        <a href="{{ route('products.edit', $product) }}" class="text-amber-600 hover:text-amber-800 text-sm font-medium">Editar</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('¿Eliminar este producto?')">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-danger hover:text-rose-800 text-sm font-medium">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-12 text-center text-foreground/40">No hay productos registrados.</td></tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-6 py-4 border-t border-divider">
            {{ $products->links() }}
        </div>
    </div>
</x-app-layout>
