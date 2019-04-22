@extends('layouts.app')

@section('content')
<div class="container">
    <!-- response and error -->
    @if(session('response'))
    <br/>
    <div class="alert alert-success text-center">
        {{session('response')}}
    </div>
    @endif
    <!-- response and error -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Status') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('status_store') }}"enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label for="status" class="col-sm-4 col-form-label text-md-right">{{ __('Status Body') }}</label>
                            <div class="col-md-6">
                            <textarea id="status"  class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" name="status" value="{{ old('status') }}" required autofocus rows="4">
                                
                            </textarea>
                            @if ($errors->has('status'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('status') }}</strong>
                                </span>
                            @endif
                            </div>
                            </div>
                                <div class="md-form">
                                    <div class="file-field">
                                        <div class="btn btn-primary btn-sm float-left">
                                            <span>Choose file</span>
                                            <input type="file" name="attachment">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" type="text" placeholder="Upload your file" >
                                            @if ($errors->has('attachment'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('attachment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                        
                        



                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Add') }}
                                </button>

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
