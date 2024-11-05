<!-- Latest News Start -->
<div class="container-fluid latest-news py-5">
    <div class="container py-5">
        <h2 class="mb-4">Latest Articles</h2>
        <div class="latest-news-carousel owl-carousel">
            @foreach ($latest_articles as $news)
                <div class="latest-news-item">
                    <div class="bg-light rounded">
                        <div class="rounded-top overflow-hidden">
                            <a href="{{ route('articles.show', $news->slug) }}">
                                <img src="{{ asset('storage/images/' . $news->image) }}"
                                     class="img-zoomin img-fluid rounded w-100" alt="{{ $news->title }}">
                            </a>
                        </div>
                        <div class="d-flex flex-column p-4">
                            <a href="{{ route('articles.show', $news->slug) }}" class="h4">{{ $news->title }}</a>
                            <div class="d-flex justify-content-between">
                                <small><i class="small text-body link-hover"></i>by {{ $news->user->name }}</small>
                                <small class="text-body d-block"><i class="fas fa-calendar-alt me-1"></i> {{ $news->created_at }}</small>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- Latest News End -->
