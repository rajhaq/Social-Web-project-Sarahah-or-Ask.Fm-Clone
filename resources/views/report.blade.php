@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 pt-5">
        <!-- response and error -->
        @include('layouts.error')
        <!-- response and error -->
            <div class="card">
                <div class="card-header default-color white-text">{{ __('Report List') }}</div>

                     <div class="card-body">
                          
                                <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Question Body</th>
                                        <th>Asker</th>
                                        <th>Time and Date</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reports->all() as $report)
                                    <tr>
                                        <td>{{ $report->question_body }}</td>
                                        <td><a class="text-primary" href="{{url("user/profile/{$report->asker_id}")}}">{{ $report->name }}</td>
                                        <td>{{date('M j, Y H:i',  strtotime($report->reported_at))}}
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
