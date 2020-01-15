<header class="banner">
  <div class="flex lg:py-5 lg:px-20">
    @if ( function_exists( 'the_custom_logo' ) )
    @php
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    @endphp
    <a class="dd-logo dd-logo--img" href="{{ home_url('/') }}">
      <img src="{{ esc_url( $custom_logo_url )}}" alt="">
    </a>
    @else
    <a class="dd-logo" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
    @endif
    <a href="#" class="dd-hamburger">
      <span class="dd-hamburger__lines"></span>
    </a>
    <nav class="nav-primary">
      @if (has_nav_menu('primary_navigation'))
      {!! wp_nav_menu(['theme_location' => 'primary_navigation', 'menu_class' => 'nav']) !!}
      @endif
    </nav>
  </div>
</header>
