<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @if (shortcode_exists('[social_links]'))
      @php echo do_shortcode('[social_links]') @endphp
      <h1>1</h1>
    @endif
  </div>
</footer>
