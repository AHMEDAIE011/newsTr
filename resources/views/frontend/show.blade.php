@extends('layouts.frontend.app')
@section('body')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">{{$meanPost->title}} .</li>
@endsection
    <!-- Single News Start-->
    <div class="single-news">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- Carousel -->
                    <div id="newsCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">

                            @foreach ($meanPost->images as $image)
                                <li data-target="#newsCarousel" data-slide-to="{{ $loop->index }}"
                                    class=" @if ($loop->index == 0) active @endif"></li>
                            @endforeach

                        </ol>
                        <div class="carousel-inner">

                            @foreach ($meanPost->images as $image)
                                <div class="carousel-item @if ($loop->index == 0) active @endif">
                                    <img src="{{ asset($image->path) }}" class="d-block w-100"
                                        alt="@if ($loop->index == 0) First Slide @endif ">
                                    <div class="carousel-caption d-none d-md-block">
                                        <h5>{{ $meanPost->title }}</h5>
                                        <p>
                                            {{ substr($meanPost->desc, 0, 80) }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                            <!-- Add more carousel-item blocks for additional slides -->
                        </div>
                        <a class="carousel-control-prev" href="#newsCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#newsCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div class="sn-content">{{ $meanPost->desc }}</div>

                    <!-- Comment Section -->
                    <div class="comment-section">
                        <!-- Comment Input -->
                        <meta name="csrf-token" content="{{ csrf_token() }}">
                          <form id="commentForm" >
                            <div class="comment-input">
                                  @csrf
                                  <input id="commentInput" name="comment"  type="text" placeholder="Add a comment..."  />
                                  <input type="hidden" name="user_id" value="1">
                                  <input type="hidden" name="post_id" value="{{$meanPost->id}}">
                                  <button type="submit">Comment</button>
                              </div>
                          </form>


                          <div id="errorMsg" class="alert alert-danger" style="display: none" role="alert">
                            A simple danger alert—check it out!
                          </div>

                        <!-- Display Comments -->
                        <div class="comments">
                            @foreach ($meanPost->comments as $comment)
                                <div class="comment">
                                    <img src=" {{ $comment->user->image }}" alt="User Image" class="comment-img" />
                                    <div class="comment-content">
                                        <span class="username">{{ $comment->user->name }}</span>
                                        <p class="comment-text">{{ $comment->comment }}...</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Show More Button -->
                        <button id="showMoreBtn" class="show-more-btn">Show more</button>
                    </div>

                    <!-- Related News -->
                    <div class="sn-related">
                        <h2>Related News</h2>
                        <div class="row sn-slider">
                            @foreach ($posts_belongsTo_category as $posts)
                                <div class="col-md-4">
                                    <div class="sn-img">
                                        <img src=" {{ asset($posts->images()->first()->path) }}" class="img-fluid"
                                            alt="Related News 1" />
                                        <div class="sn-title">
                                            <a
                                                href="{{ route('frontend.post.show', $posts->slug) }}">{{ $posts->title }}</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar-widget">
                            <h2 class="sw-title">In This Category</h2>
                            <div class="news-list">
                                @foreach ($posts_belongsTo_category as $posts)
                                    <div class="nl-item">
                                        <div class="nl-img">
                                            <img src=" {{ asset($posts->images()->first()->path) }}" />
                                        </div>
                                        <div class="nl-title">
                                            <a
                                                href="{{ route('frontend.post.show', $posts->slug) }}">{{ $posts->title }}</a>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src=" {{ asset('assets/frontend') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="tab-news">
                                <ul class="nav nav-pills nav-justified">
                                    <li class="nav-item">
                                        <a class="nav-link active" data-toggle="pill" href="#featured">Latest Post</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" data-toggle="pill" href="#popular">Popular News</a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div id="featured" class="container tab-pane active">
                                        @foreach ($latest_three_posts as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title="{{ $post->title }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div id="popular" class="container tab-pane fade">

                                        @foreach ($gretest_posts_comments as $post)
                                            <div class="tn-news">
                                                <div class="tn-img">
                                                    <img src="{{ asset($post->images->first()->path) }}" />
                                                </div>
                                                <div class="tn-title">
                                                    <a href="{{ route('frontend.post.show', $post->slug) }}"
                                                        title="{{ $post->title }}">{{ $post->title }}</a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src=" {{ asset('assets/frontend') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">News Category</h2>
                            <div class="category">
                                <ul>
                                    @foreach ($categories as $category)
                                        <li><a
                                                href="">{{ $category->name }}</a><span>({{ $category->posts()->count() }})</span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <div class="image">
                                <a href="https://htmlcodex.com"><img src=" {{ asset('assets/frontend') }}/img/ads-2.jpg"
                                        alt="Image" /></a>
                            </div>
                        </div>

                        <div class="sidebar-widget">
                            <h2 class="sw-title">Tags Cloud</h2>
                            <div class="tags">
                                <a href="">National</a>
                                <a href="">International</a>
                                <a href="">Economics</a>
                                <a href="">Politics</a>
                                <a href="">Lifestyle</a>
                                <a href="">Technology</a>
                                <a href="">Trades</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Single News End-->
@endsection
@push('js')
    <script>
        // show more 
        $(document).on('click', '#showMoreBtn', function(e) {
            e.preventDefault();
            $.ajax({
                url: "{{ route('frontend.post.getAllComment', $meanPost->slug) }}",
                type: "GET",
                success: function(data) {
                    $('.comments').empty();
                    $.each(data, function(key, comment) {
                        $('.comments').prepend(`
                          <div class="comment">
                            <img src="${comment.user.image}" alt="User Image" class="comment-img" />
                            <div class="comment-content">
                              <span class="username">${comment.user.name}</span>
                              <p class="comment-text">${comment.comment}...</p>
                            </div>
                          </div>
                        `);
                    });
                $('#showMoreBtn').hide();
                },
                error: function(data) {
                    ""
                },
            });
        });

        // إعداد CSRF Token
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        // save comment 
        $(document).on('submit','#commentForm',function(e){
          e.preventDefault();
          
          var formData = new FormData($(this)[0]);
          $('#commentInput').val('');
          
         $.ajax({
          url: "{{route('frontend.post.comment.store')}}",
          type: "POST",
          data: formData,
          processData: false,
          contentType: false,
          success:function(data){},
          error:function(data){},

          success: function(data) {
            $('.comments').prepend(`
                          <div class="comment">
                            <img src="${data.comment.user.image}" alt="User Image" class="comment-img" />
                            <div class="comment-content">
                              <span class="username">${data.comment.user.name}</span>
                              <p class="comment-text">${data.comment.comment}...</p>
                            </div>
                          </div>
                        `);
                $('#errorMsg').hide();

                },
                error: function(data) {
                    var res = $.parseJSON(data.responseText);
                    $('#errorMsg').text(res.errors.comment).show();
                    
                },

         });
        });


    </script>
@endpush
