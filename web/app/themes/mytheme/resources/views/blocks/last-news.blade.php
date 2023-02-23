{{--
  Title: Last news
  Description: Add a section with the lastest news
  Category: formatting
  Icon: admin-page
  Keywords: section last news
--}}

@php $fields = isset($fields['last_news']) ? $fields['last_news'] : null @endphp

@if($fields)
    <div data-{{ $block['id'] }} class="wp-block-last-news">
        @if($fields['title'])
            <h2 class="wp-block-last-news-title">{!! $fields['title'] !!}</h2>
        @endif
        <div class="wp-block-last-news-swiper swiper">
            <div class="wp-block-last-news-swiper-wrapper swiper-wrapper">
                @foreach($posts as $post)
                    <div class="wp-block-last-news-swiper-slide swiper-slide">
                        <a href="{{ $post->url }}">
                            @if($post->thumbnail)
                                <div class="wp-block-last-news-swiper-slide-image">{!! $post->thumbnail !!}</div>
                            @endif
                            <div class="wp-block-last-news-swiper-slide-title">{{ $post->post_title }}</div>
                            <div class="wp-block-last-news-swiper-slide-date">{{ $post->date }}</div>
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="wp-block-last-news-navigation">
                <div class="wp-block-last-news-navigation-prev swiper-button-prev">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none">
                        <path d="M7.12436 1L1.12436 7L7.12436 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <div class="wp-block-last-news-navigation-next swiper-button-next">
                    <svg width="9" height="14" viewBox="0 0 9 14" fill="none">
                        <path d="M1.64703 1L7.64703 7L1.64703 13" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
@endif