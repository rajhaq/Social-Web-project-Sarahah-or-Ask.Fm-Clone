@extends('layouts.custom')

@section('content')
<div class="container">
<!-- response and error -->
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 pt-5">
            <div class="card">
                <div class="card-header  default-color white-text">{{ __('Search Result of ') }}{{$search}}</div>

                     <div class="card-body">
                          
                                <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Location</th>
                                        
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($results->all() as $result)
                                    <tr>
                                        <td><a class="text-primary" href="{{url("user/profile/{$result->id}")}}">{{ $result->name }}</a></td>
                                        <td>{{ $result->location }}</td>
                                        <td>

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
