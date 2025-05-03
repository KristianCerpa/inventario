
<div class="form-group mb-3">
        <label class="form-label">  {{ Form::label('product_id') }}</label>
        <div>
            <select name="product_id"  class="form-control @error('product_id') is-invalid @enderror"  placeholder="Product Id" required>
                <option value="">Seleccione un Producto</option>
                @foreach($products as $id => $name)
                    <option value="{{$id}}" {{ old('product_id', $entry->product_id) == $id ? 'selected' : '' }}>
                        {{$name}}
                    </option>
                @endforeach
            </select>
            @error('product_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-hint">Seleccione el producto.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">  {{ Form::label('type') }}</label>
        <div>
            <select name="type" class="form-control @error('type') is-invalid @enderror" placeholder="Type" required>
                <option value="">Seleccione el Tipo</option>
                @foreach($types as $key => $value)
                    <option value="{{$key}}" {{ old('type', $entry->type) == $key ? 'selected' : '' }}>
                        {{$value}}
                    </option>
                @endforeach
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
            <small class="form-hint">Seleccione el tipo de entrada.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">  {{ Form::label('quantity') }}</label>
        <div>
            {{ Form::text('quantity', $entry->quantity, ['class' => 'form-control' . ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity']) }}
            {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Ingrese la cantidad.</small>
        </div>
    </div>
    <div class="form-group mb-3">
        <label class="form-label">  {{ Form::label('notes') }}</label>
        <div>
            {{ Form::text('notes', $entry->notes, ['class' => 'form-control' . ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => 'Notes']) }}
            {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
            <small class="form-hint">Ingrese notas adicionales.</small>
        </div>
    </div>

    <div class="form-footer">
        <div class="text-end">
            <div class="d-flex">
                <a href="#" class="btn btn-danger">Cancel</a>
                <button type="submit" class="btn btn-primary ms-auto ajax-submit">Submit</button>
            </div>
        </div>
    </div>
