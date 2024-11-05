<!-- Most Populer News Start -->
<div class="container-fluid populer-news py-5">
    <div class="container py-5">
        <div class="tab-class mb-4">
            <div class="row g-4">
                <div class="col-lg-8 col-xl-9">
                    <div class="d-flex flex-column flex-md-row justify-content-md-between border-bottom mb-4">
                        <h1 class="mb-4">All Categories</h1>
                        <ul class="nav nav-pills d-inline-flex text-center">
                            @foreach ($categories as $category)
                                <li class="nav-item mb-3">
                                    <a class="d-flex py-2 bg-light rounded-pill {{ $loop->first ? 'active' : '' }} me-2"
                                        data-bs-toggle="pill" href="#tab-{{ $category->id }}">
                                        <span class="text-dark" style="width: 100px;">{{ $category->name }}</span>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="tab-content mb-4">
                        @foreach ($categories as $category)
                            <div id="tab-{{ $category->id }}"
                                class="tab-pane fade show {{ $loop->first ? 'active' : '' }}">
                                <div class="row g-4">
                                    @foreach ($category->articles as $article)
                                        <div class="col-lg-4">
                                            <div class="position-relative rounded overflow-hidden">
                                                <img src="{{ asset('storage/images/' . $article->image) }}"
                                                    class="img-zoomin img-fluid rounded w-100"
                                                    alt="{{ $article->title }}">
                                                <div class="position-absolute text-white px-4 py-2 bg-primary rounded"
                                                    style="top: 20px; right: 20px;">
                                                    {{ $category->name }}
                                                </div>
                                            </div>
                                            <div class="my-4">
                                                <a href="{{ route('articles.show', $article->slug) }}"
                                                    class="h4">{{ $article->title }}</a>
                                            </div>
                                            <div class="d-flex justify-content-between">
                                                <a href="#" class="text-dark link-hover me-3"><i
                                                        class="fa fa-clock"></i>
                                                    {{ $article->created_at->diffForHumans() }}</a>
                                                <a href="#" class="text-dark link-hover me-3"><i
                                                        class="fa fa-eye"></i> {{ $article->views }} Views</a>
                                            </div>
                                            <p class="my-4">{{ Str::limit($article->content, 200, '...') }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="border-bottom mb-4">
                        <h2 class="my-4">Latest Articles</h2>
                    </div>
                    <div class="whats-carousel owl-carousel">
                        @foreach ($latest_articles as $news)
                            <div class="latest-news-item">
                                <div class="bg-light rounded">
                                    <div class="rounded-top overflow-hidden">
                                        <a href="{{ route('articles.show', $news->slug) }}">
                                            <img src="{{ asset('storage/images/' . $news->image) }}"
                                                 class="img-zoomin img-fluid rounded-top w-100" alt="{{ $news->title }}">
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column p-4">
                                        <a href="{{ route('articles.show', $news->slug) }}" class="h4">{{ $news->title }}</a>
                                        <div class="d-flex justify-content-between">
                                            <a href="#" class="small text-body link-hover">by {{ $news->user->name }}</a>
                                            <small class="text-body d-block">
                                                <i class="fas fa-calendar-alt me-1"></i> {{ $news->created_at->format('d M Y') }}
                                            </small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-5 lifestyle">
                        <div class="border-bottom mb-4">
                            <h1 class="mb-4">Top Views</h1>
                        </div>
                        <div class="row g-4">
                            @foreach ($top_lifestyle as $top_view)
                            <div class="col-lg-6">
                                <div class="lifestyle-item rounded">
                                    <a href="{{ route('articles.show', $top_view->slug) }}">
                                        <img src="{{ asset('storage/images/' . $top_view->image) }}" class="img-fluid w-100 rounded" alt="{{ $top_view->title }}">
                                    </a>
                                    <div class="lifestyle-content">
                                        <div class="mt-auto">
                                            <a href="{{ route('articles.show', $top_view->slug) }}" class="h4 text-white link-hover">
                                                {{ $top_view->title }}
                                            </a>
                                            <div class="d-flex justify-content-between mt-4">
                                                <a href="#" class="small text-white link-hover">By {{ $top_view->title }}</a>
                                                <small class="text-white d-block">
                                                    <i class="fas fa-calendar-alt me-1"></i>
                                                    {{ optional($top_view->created_at)->format('d M Y') }}
                                                </small>
                                            </div>
                                            <p class="mb-0 fs-5 text-white">
                                                <i class="fa fa-eye"> {{ $top_view->views }} Views</i>
                                            </p>
                                            <p class="mb-0 fs-5 text-white">
                                                <i class="fa fa-folder"> {{ $top_view->category->name }}</i>
                                            </p>
                                            <p class="mb-0 fs-5 text-white">
                                                <i class="fa fa-tag">
                                                    @foreach ($top_view->tags as $tag)
                                                        {{ $tag->name }}@if (!$loop->last), @endif
                                                    @endforeach
                                                </i>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-xl-3">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="p-3 rounded border">
                                <h4 class="mb-4">Stay Connected</h4>
                                <div class="row g-4">
                                    <div class="col-12">
                                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}"
                                            class="w-100 rounded btn btn-primary d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-facebook-f btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">13,977 Fans</span>
                                        </a>
                                        <a href="https://www.youtube.com/sharer/sharer.php?u={{ url('https://www.youtube.com') }}"
                                            class="w-100 rounded btn btn-danger d-flex align-items-center p-3 mb-2">
                                            <i class="fab fa-youtube btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">7,999 Subscriber</span>
                                        </a>
                                        <a href="https://www.instagram.com/sharer/sharer.php?u={{ url()->current() }}"
                                            class="w-100 rounded btn btn-dark d-flex align-items-center p-3 mb-2">
                                            <i
                                                class="fab fa-instagram btn btn-light btn-square rounded-circle me-3"></i>
                                            <span class="text-white">19,764 Follower</span>
                                        </a>
                                    </div>
                                </div>

                                <h4 class="my-4">Popular Articles</h4>
                                <div class="row g-4">
                                    @foreach ($popular_articles as $articles)
                                        <div class="col-12">
                                            <div class="row g-4 align-items-center features-item">
                                                <div class="col-4">
                                                    <div class="rounded-circle position-relative">
                                                        <div class="overflow-hidden rounded-circle">
                                                            <img src="{{ asset('storage/images/' . $articles->image) }}"
                                                                class="img-zoomin img-fluid rounded w-100"
                                                                alt="{{ $articles->title }}">
                                                        </div>
                                                        <span
                                                            class="rounded-circle border border-2 border-white bg-primary btn-sm-square text-white position-absolute"
                                                            style="top: 10%; right: -10px;">
                                                            {{ $articles->views }}
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-8">
                                                    <div class="features-content d-flex flex-column">
                                                        <p class="text-uppercase mb-2">{{ $articles->category->name }}
                                                        </p>
                                                        <a href="{{ route('articles.show', $articles->slug) }}"
                                                            class="h6">
                                                            {{ $articles->title }}
                                                        </a>
                                                        <small class="text-body d-block">
                                                            <i class="fas fa-calendar-alt me-1"></i>
                                                            {{ \Carbon\Carbon::parse($articles->published_at)->format('d M Y') }}
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                    <div class="col-lg-12">
                                        <div class="border-bottom my-3 pb-3">
                                            <h4 class="mb-0">Trending Tags</h4>
                                        </div>
                                        <ul class="nav nav-pills d-inline-flex text-center mb-4">
                                            @foreach ($tags as $tag)
                                            <li class="nav-item mb-3">
                                                <a class="d-flex py-2 bg-light rounded-pill me-2" href="{{ route('frontend.tag', $tag->slug) }}">
                                                    <span class="text-dark link-hover" style="width: 90px;">#{{ $tag->name }}</span>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="position-relative banner-2">
                                            <img src="{{ asset('assets/frontend') }}/img/shopee.png" class="img-fluid w-100 rounded"
                                                alt="">
                                            <div class="text-center banner-content-2">
                                                <h6 class="mb-2">The Most Populer</h6>
                                                <p class="text-white mb-2">News & Magazine WP Theme</p>
                                                <a href="https://shopee.co.id/product_id" class="btn btn-primary text-white px-4">Shop Now</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Most Populer News End -->

