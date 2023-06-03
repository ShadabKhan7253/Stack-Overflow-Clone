<div class="row mt-4">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3>{{ \Illuminate\Support\Str::plural('Answer', $question->answers_count) }}</h3>
            </div>
            <div class="card-body">
                @foreach ($question->answers as $answer)
                    {!! $answer->body !!}

                    <div class="d-flex justify-content-between me-3">
                        <div class="d-flex">
                            <div>
                                <a href="#" title="Up Vote" class="up-vote d-block text-center text-dark"><i
                                        class="fa fa-caret-up fa-3x"></i></a>
                                <h4 class="vote-count text-muted text-center m-0">{{ $answer->votes_count }}</h4>
                                <a href="#" title="Down Vote" class="down-vote d-block text-center text-dark"><i
                                        class="fa fa-caret-down fa-3x"></i></a>
                            </div>
                            <div class="ms-4 mt-3">
                                <a href="#" title="Mark as Fav" class="favorite d-block text-center mb-1"><i
                                        class="fa fa-star fa-2x text-dark"></i></a>
                                <h4 class="fav-count m-0 text-center">123</h4>
                            </div>
                        </div>
                        <div>
                            <div class="text-muted mb-2 text-end">
                                Answered: {{ $answer->created_date }}
                            </div>
                            <div class="d-flex mb-2">
                                <div>
                                    <img src="{{ $answer->author->avatar }}">
                                </div>
                                <div class="mt-2">
                                    {{ $answer->author->name }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
