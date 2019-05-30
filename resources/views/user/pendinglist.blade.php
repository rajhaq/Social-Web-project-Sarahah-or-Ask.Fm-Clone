@extends('layouts.custom')

@section('content')
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-md-8 pt-5">
        <!-- response and error -->
        @include('layouts.error')
        <!-- response and error -->
            <div class="card">
                <div class="card-header default-color white-text">{{ __('Pending Question List') }}</div>

                     <div class="card-body">
                          
                                <div class="table-responsive">          
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Question Body</th>
                                        <th>Reply</th>
                                        <th>Delete</th>
                                        <th>Report</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($questions->all() as $question)
                                    <tr>
                                        <td>
                                        @if($question->anonymous==0)
                                            {{ $question->name }}
                                        
                                        @else
                                            Anonymous
                                        @endif
                                        </td>
                                        <td>{{ $question->question_body }}</td>
                                        <td>
                                        <button type="button" data-toggle="modal" data-target="#{{$question->id}}" class="btn btn-default btn-sm" href="{{ url("status/edit/{$question->id}")}}" ><i class="fa fa-mail-reply-all" aria-hidden="true"></i> </button>
                                        
                                                <!-- Modal -->
                                                <div class="modal fade" id="{{$question->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Question: {{ $question->question_body }}</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                            <form method="POST" action="{{ route('answer_store') }}"enctype="multipart/form-data">
                                                            @csrf
                                                                <textarea id="answer"  class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" name="answer" value="{{ old('answer') }}" required autofocus rows="4"></textarea>
                                                            </div>
                                                            
                                                            <input id="hide" type="hidden" name="receiver_id" value="{{ $question->receiver_id }}"  >
                                                            <input id="hide" type="hidden" name="news_id" value="{{ $question->news_id }}"  >

                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-elegant" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-default">Reply</button>
                                                            </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- model end -->
                                        </td>
                                        <td>
                                        <a type="button" class="btn btn-danger btn-sm" href="{{ url("question/delete/{$question->id}")}}" ><i class="fa fa-trash" aria-hidden="true"></i> </a>
                                        </td>
                                        <td>
                                        <form method="POST" action="{{ route('reportstore') }}"enctype="multipart/form-data">
                                        <input type="hidden" value="{{$question->user_id}}" name="asker_id">
                                        <input type="hidden" value="{{$question->que}}" name="question_id">
                                        @csrf
                                            <button type="submit" class="btn btn-primary btn-sm"  ><i class="fa fa-question" aria-hidden="true"></i></a>
                                        </form>
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
