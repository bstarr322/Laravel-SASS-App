@extends('layouts.admin')

@section('content')
    <h1>Settings</h1>
    <hr class="mb-4">

    <form method="POST" action="{{ route('admin.settings.update') }}" class="row">
        {{ csrf_field() }}
        {{ method_field('PUT') }}

        <div class="col-md-4">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('model_list_count') ? ' has-danger' : '' }}">
                        <label for="model_list_count" class="form-control-label">Model-list count</label>
                        <input id="model_list_count"
                               type="number"
                               class="form-control{{ $errors->has('model_list_count') ? ' form-control-danger' : '' }}"
                               name="model_list_count"
                               value="{{ old('model_list_count') ?: $settings->get('model_list_count') }}"
                               autocomplete="off">
                        @if ($errors->has('model_list_count'))
                            <div class="form-control-feedback">
                                {{ $errors->first('model_list_count') }}
                            </div>
                        @endif
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group{{ $errors->has('botm_count') ? ' has-danger' : '' }}">
                        <label for="botm_count" class="form-control-label">Babe of the Month count</label>
                        <input id="botm_count"
                               type="number"
                               class="form-control{{ $errors->has('botm_count') ? ' form-control-danger' : '' }}"
                               name="botm_count"
                               value="{{ old('botm_count') ?: $settings->get('botm_count') }}"
                               autocomplete="off">
                        @if ($errors->has('botm_count'))
                            <div class="form-control-feedback">
                                {{ $errors->first('botm_count') }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-12">
            <button type="submit" class="btn btn-success">Update</button>
        </div>
    </form>
@endsection
