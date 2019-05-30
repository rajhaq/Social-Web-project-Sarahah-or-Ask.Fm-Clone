@extends('layouts.custom')

@section('content')
<div class="container mt-5" >
    <div class="row pt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header default-color text-white">{{ __('Status Update') }}</div>
                <div class="card-body">
                    <div class="tab-content">
                            <form method="POST" action="{{ route('status_update') }}"enctype="multipart/form-data">
                            @csrf
                                <textarea id="status"  class="form-control{{ $errors->has('status') ? ' is-invalid' : '' }}" 
                                name="status" value="{{ old('status') }}" required autofocus rows="3">{{$status->status_body}}</textarea>
                                @if ($errors->has('status'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                                <div class="md-form">
                                    <div class="file-field">
                                        <div class="btn btn-default btn-sm float-left">
                                            <span>Choose file</span>
                                            <input type="file"  name="attachment">
                                        </div>
                                        <div class="file-path-wrapper">
                                            <input class="file-path validate" name="attachment" value="{{$status->attachment}}" type="text" placeholder="Upload your file" >
                                            @if ($errors->has('attachment'))
                                                <span class="invalid-feedback">
                                                    <strong>{{ $errors->first('attachment') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="md-form">
                                    <div class="file-field">
                                    <input type="hidden" value="{{$status->id}}" name="status_id">
                                        <button type="submit" class="btn btn-outline-default btn-rounded waves-effect">Post</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
