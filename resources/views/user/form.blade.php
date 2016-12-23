<div class="form-group {{ ($errors->has('name')) ? 'has-error' : '' }}">
    {!! Form::label('name', 'Name', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'name']) !!}
        <p class="help-block">{{ ($errors->has('name') ? $errors->first('name') : '') }}</p>
    </div>
</div>
<div class="form-group {{ ($errors->has('email')) ? 'has-error' : '' }}">
    {!! Form::label('email', 'Email', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'email']) !!}
        <p class="help-block">{{ ($errors->has('email') ? $errors->first('email') : '') }}</p>
    </div>
</div>
<div class="form-group {{ ($errors->has('description')) ? 'has-error' : '' }}">
    {!! Form::label('description', 'Description', ['class' => 'col-sm-2 control-label']) !!}
    <div class="col-sm-4">
        {!! Form::email('description', null, ['class' => 'form-control', 'placeholder' => 'description']) !!}
        <p class="help-block">{{ ($errors->has('description') ? $errors->first('description') : '') }}</p>
    </div>
</div>