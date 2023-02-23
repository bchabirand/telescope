<footer class="footer">
  <div class="container">
    <div class="footer-wrapper">
      <a class="footer-brand" href="{{ home_url('/') }}">
        <img src="@asset('images/logo.svg')" alt="Telescope">
        <span>Telescope</span>
      </a>

      @if (has_nav_menu('footer_1'))
        <nav class="footer-nav" aria-label="{{ wp_get_nav_menu_name('footer_1') }}">
          <div class="footer-nav-title">{{ wp_get_nav_menu_name('footer_1') }}</div>
          {!! wp_nav_menu(['theme_location' => 'footer_1', 'menu_class' => 'footer-nav-list', 'echo' => false]) !!}
        </nav>
      @endif

      @if (has_nav_menu('footer_2'))
        <nav class="footer-nav" aria-label="{{ wp_get_nav_menu_name('footer_2') }}">
          <div class="footer-nav-title">{{ wp_get_nav_menu_name('footer_2') }}</div>
          {!! wp_nav_menu(['theme_location' => 'footer_2', 'menu_class' => 'footer-nav-list', 'echo' => false]) !!}
        </nav>
      @endif

      @if (has_nav_menu('footer_3'))
        <nav class="footer-nav" aria-label="{{ wp_get_nav_menu_name('footer_3') }}">
          <div class="footer-nav-title">{{ wp_get_nav_menu_name('footer_3') }}</div>
          {!! wp_nav_menu(['theme_location' => 'footer_3', 'menu_class' => 'footer-nav-list', 'echo' => false]) !!}
        </nav>
      @endif

      <nav class="footer-nav">
        <div class="footer-nav-title">Suivez-nous</div>

        @php $networks = ['facebook', 'instagram', 'twitter', 'twitch'] @endphp
        <ul class="footer-nav-social">
          @foreach ($networks as $network)
            @if($socialNetworks[$network])
              <li>
                <a href="{{ $socialNetworks[$network] }}" target="_blank">
                  @php $url = "images/" . $network . ".svg" @endphp
                  <img src="@asset($url)" alt="{{ $network }}">
                </a>
              </li>
            @endif
          @endforeach
        </ul>
      </nav>
    </div>
  </div>
</footer>
