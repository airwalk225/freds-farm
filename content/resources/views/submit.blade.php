@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <h1>Submit a cow</h1>
            <form action="/submit" method="post">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        Please fix the following errors
                    </div>
                @endif

                {!! csrf_field() !!}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{ old('name') }}">
                    @if($errors->has('name'))
                        <span class="help-block">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('breed') ? ' has-error' : '' }}">
                    <label for="breed">Breed</label>
                    <input type="text" class="form-control" id="breed" name="breed" placeholder="Breed" value="{{ old('breed') }}">
                    @if($errors->has('breed'))
                        <span class="help-block">{{ $errors->first('breed') }}</span>
                    @endif
                </div>
                <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                    <label for="age">Age</label>
                    <textarea class="form-control" id="age" name="age" placeholder="Age">{{ old('age') }}</textarea>
                    @if($errors->has('age'))
                        <span class="help-block">{{ $errors->first('age') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-default">Add</button>
            </form>
        </div>
    </div>
@endsection