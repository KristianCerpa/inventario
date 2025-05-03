
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('product_id') }}</label>
    <div>
        {{ Form::text('product_id', $output->product_id, ['class' => 'form-control' .
        ($errors->has('product_id') ? ' is-invalid' : ''), 'placeholder' => 'Product Id']) }}
        {!! $errors->first('product_id', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">output <b>product_id</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('type') }}</label>
    <div>
        {{ Form::text('type', $output->type, ['class' => 'form-control' .
        ($errors->has('type') ? ' is-invalid' : ''), 'placeholder' => 'Type']) }}
        {!! $errors->first('type', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">output <b>type</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('quantity') }}</label>
    <div>
        {{ Form::text('quantity', $output->quantity, ['class' => 'form-control' .
        ($errors->has('quantity') ? ' is-invalid' : ''), 'placeholder' => 'Quantity']) }}
        {!! $errors->first('quantity', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">output <b>quantity</b> instruction.</small>
    </div>
</div>
<div class="form-group mb-3">
    <label class="form-label">   {{ Form::label('notes') }}</label>
    <div>
        {{ Form::text('notes', $output->notes, ['class' => 'form-control' .
        ($errors->has('notes') ? ' is-invalid' : ''), 'placeholder' => 'Notes']) }}
        {!! $errors->first('notes', '<div class="invalid-feedback">:message</div>') !!}
        <small class="form-hint">output <b>notes</b> instruction.</small>
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
