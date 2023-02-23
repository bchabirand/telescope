<header class="header">
  <div class="container">
    <div class="header-wrapper">
      <a class="header-brand" href="{{ home_url('/') }}">
        <img src="@asset('images/logo.svg')" alt="Telescope">
        <span>Telescope</span>
      </a>

      @if (has_nav_menu('primary_navigation'))
        <nav class="header-primary-nav header-desktop" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header-nav', 'echo' => false]) !!}
        </nav>
      @endif

      @if (has_nav_menu('secondary_navigation'))
        <nav class="header-secondary-nav header-desktop" aria-label="{{ wp_get_nav_menu_name('secondary_navigation') }}">
          {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'header-nav', 'echo' => false]) !!}
        </nav>
      @endif

      <button class="header-burger" data-toggle-nav>
        <svg class="burger" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 8H20" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M4 16H20" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>

        <svg class="close" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M18 6L6 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
          <path d="M6 6L18 18" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
      </button>
    </div>
  </div>

  <div class="menu-mobile">
    @if (has_nav_menu('primary_navigation'))
        <nav class="header-primary-nav" aria-label="{{ wp_get_nav_menu_name('primary_navigation') }}">
          {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'header-nav', 'echo' => false]) !!}
        </nav>
      @endif

      @if (has_nav_menu('secondary_navigation'))
        <nav class="header-secondary-nav" aria-label="{{ wp_get_nav_menu_name('secondary_navigation') }}">
          {!! wp_nav_menu(['theme_location' => 'secondary_navigation', 'menu_class' => 'header-nav', 'echo' => false]) !!}
        </nav>
      @endif
  </div>
</header>
