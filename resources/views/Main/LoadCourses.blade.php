@foreach($lessons as $lesson)
    @if($loop->iteration === 1 || $loop->iteration === 4 || $loop->iteration === 7 || $loop->iteration === 10)
        <div class="row" style="direction: rtl" id="row{{ $loop->iteration }}">
            @endif
            @if($loop->iteration === 3 || $loop->iteration === 9)
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 cardLink lastCard">
            @else
                <div class="col-lg-4 col-md-6 col-sm-6 col-xs-12 cardLink">
            @endif
                <a href="{{ route('lessons.show', $lesson->id) }}">
                    <div class="courseCard card">
                        <!--Over card image elements instructor image and jalase counts-->
                        <img class="card-img-top" src="lessonPhoto/{{ count($lesson->photo) != 0 ? $lesson->photo[0]['path'] : "coun.png" }}" alt="Card image cap">
                        <div class="row topCard">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-6">
                                <p class="jalaseCounts"><i class="fa fa-eye fa-1x"></i> {{ $lesson->seen }}&nbsp;بازدید </p>
                            </div>
                            <div class="col-lg-7 col-md-7 col-sm-7 col-6">
                                <p><img class="instructor_img" src="UsersPhotos/{{ count($lesson->user->photos) != 0 ? $lesson->user->photos[0]['path'] : 'icone.png' }}"> {{ $lesson->user['full_name'] }}</p>
                            </div>
                        </div>
                        <!--Card body elements like title and text and cost and kind-->
                        <div class="card-block">
                            <h5 class="card-title">{{ $lesson->lesson_name }}</h5>
                            <p class="card-text">{{ str_limit($lesson->lesson_desc, 70) }}</p>
                            <div class="row">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                    <p>{{ isset($lesson->cost) ? "$lesson->cost تومان" : 'رایگان' }}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                    <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($lesson->categories[0]['name'], 7) }}</p>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                    <p>{{ $lesson->created_at->format('Y/m/d') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            @if($loop->iteration === 3 || $loop->iteration === 6 || $loop->iteration === 9 || $loop->last)
        </div>
    @endif
@endforeach
<link rel="stylesheet" href="css/bootstrap-pag.css" crossorigin="anonymous">
<nav style="text-align: center;" aria-label="Page navigation example">
    {{ $lessons->links() }}
</nav>