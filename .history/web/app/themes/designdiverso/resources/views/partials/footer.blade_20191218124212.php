<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @php if ( function_exists( 'social_links' ) ) echo social_links(); @php
  </div>
</footer>
