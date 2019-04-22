@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Own Status List') }}</div>

                     <div class="card-body">
                          
                                <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Body</th>
                                        <th>Attachment</th>
                                        <th>Action</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($statuses->all() as $status)
                                    <tr>
                                        <td>{{ $status->status_body }}</td>
                                        <td>{{ $status->attachment }}</td>
                                        <td>
                                        <a href="{{ url("status/edit/{$status->id}")}}"> <i class="fas fa-edit"></i> </a>
                                        <a href="{{url("status/delete/{$status->id}")}}"> <i class="fas fa-trash-alt"></i> </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
