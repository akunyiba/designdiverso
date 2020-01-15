<header class="banner lg:h-20">
  <div class="flex">
    @if ( function_exists( 'the_custom_logo' ) )
    @php
    $custom_logo_id = get_theme_mod( 'custom_logo' );
    $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id , 'full' );
    @endphp
    <a class="dd-logo border-none flex" href="{{ home_url('/') }}">
      <img class="w-48 md:w-64" src="{{ esc_url( $custom_logo_url )}}" alt="">
    </a>
    @else
    <a class="dd-logo border-none" href="{{ home_url('/') }}">{{ get_bloginfo('name', 'display') }}</a>
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
