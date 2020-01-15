<footer class="site-footer text-primary py-10 font-proxima">
  <div class="container">
    @php dynamic_sidebar('sidebar-footer') @endphp
    @if ( function_exists( 'socialLinks' ) ) 
    socialLinks()
    @endif
  </div>
</footer>
