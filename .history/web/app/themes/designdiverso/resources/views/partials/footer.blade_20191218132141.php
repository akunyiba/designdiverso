<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @if (shortcode_exists('[box]'))
      @php echo do_shortcode('[box]') @endphp
      <h1>1</h1>
    @endif
  </div>
</footer>
