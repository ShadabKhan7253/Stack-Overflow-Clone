@extends('layouts.app')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">All Questions</div>
                    @foreach ($questions as $question)
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0 statistics">
                                    <div class="votes text-center mb-3">
                                        <strong class="d-block">{{ $question->votes_count }}</strong> Votes
                                    </div>
                                    <div class="votes text-center mb-3 answers {{ $question->answer_styles }}">
                                        <strong class="d-block">{{ $question->answers_count }}</strong> Answers
                                    </div>
                                    <div class="votes text-center mb-3">
                                        <strong class="d-block">{{ $question->views_count }}</strong> Views
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h4>
                                        <a href="{{ $question->url }}">{{ $question->title }}</a>
                                    </h4>
                                    <p>
                                        Asked By: <a href="#">{{ $question->owner->name }}</a>
                                        <span class="text-muted">{{ $question->created_date }}</span>
                                    </p>
                                    <p>
                                        {{ \Illuminate\Support\Str::limit($question->body, 250) }}
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach

                    <div class="card-footer">
                        {{ $questions->links('vendor.pagination.bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
