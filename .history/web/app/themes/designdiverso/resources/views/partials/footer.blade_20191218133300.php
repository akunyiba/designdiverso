<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @php if ( function_exists( 'ea_social_links_shortcode' ) ) echo ea_social_links_shortcode() @endphp
    @if (shortcode_exists('[social_links]'))
      @php echo do_shortcode('[social_links]') @endphp
      <h1>1</h1>
    @endif
  </div>
</footer>
