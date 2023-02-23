{{--
  Title: Banner
  Description: Add a banner with some content and a background image
  Category: formatting
  Icon: layout
  Keywords: banner section
--}}

@php $fields = isset($fields['banner']) ? $fields['banner'] : null @endphp

@if($fields)
    <div data-{{ $block['id'] }} class="wp-block-banner">
        @if($fields['image'])
            <div class="wp-block-banner-image">
                <img src="{{ $fields['image']['url'] }}" alt="{{ $fields['image']['alt'] }}" loading="lazy"/>
            </div>
        @endif

        <div class="wp-block-banner-wrapper">
            @if($fields['title'])
                <h1 class="wp-block-banner-title">{{ $fields['title'] }}</h1>
            @endif

            @if($fields['content'])
                <p class="wp-block-banner-content">{{ $fields['content'] }}</p>
            @endif

            @if($fields['button'])
                <div class="wp-block-banner-button">
                    <a href="{{ $fields['button']['url'] }}" class="btn btn--secondary" target="{{ $fields['button']['target'] ? "_blank" : "_self" }}">{{ $fields['button']['title'] }}</a>
                </div>
            @endif
        </div>
    </div>
@endif
