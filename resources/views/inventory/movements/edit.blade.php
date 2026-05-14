<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-foreground leading-tight">Editar Movimiento</h2>
    </x-slot>

    <div class="bg-white rounded-xl shadow-sm border border-divider p-6 max-w-lg">
        <form action="{{ route('inventory.movements.update', $movement) }}" method="POST">
            @csrf @method('PUT')
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Producto</label>
                <select name="product_id" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                    @foreach($products as $product)
                    <option value="{{ $product->id }}" {{ old('product_id', $movement->product_id) == $product->id ? 'selected' : '' }}>
                        {{ $product->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Tipo</label>
                <select name="type" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
                    <option value="entry" {{ old('type', $movement->type) === 'entry' ? 'selected' : '' }}>Ingreso</option>
                    <option value="exit" {{ old('type', $movement->type) === 'exit' ? 'selected' : '' }}>Egreso</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Cantidad</label>
                <input type="number" min="1" name="quantity" value="{{ old('quantity', $movement->quantity) }}" required class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium text-foreground/80 mb-1">Notas</label>
                <textarea name="notes" rows="3" class="w-full border-divider rounded-lg shadow-sm focus:border-primary focus:ring focus:ring-primary/20">{{ old('notes', $movement->notes) }}</textarea>
            </div>
            <div class="flex gap-3">
                <button type="submit" class="bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">Actualizar</button>
                <a href="{{ route('inventory.movements') }}" class="bg-white border border-divider hover:bg-surface text-foreground/80 px-4 py-2 rounded-lg text-sm font-medium transition-colors">Cancelar</a>
            </div>
        </form>
    </div>
</x-app-layout>
