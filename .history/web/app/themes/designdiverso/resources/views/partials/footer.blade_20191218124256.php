<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @if ( function_exists( 'social_links' ) ) 
    social_links();
    @endif
  </div>
</footer>
