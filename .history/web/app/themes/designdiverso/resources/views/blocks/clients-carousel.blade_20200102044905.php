{{--
  Title: Clients Carousel
  Description: Clients Carousel
  Category: dd-blocks
  Icon: groups
  Keywords: logos, carousel, carousel slider, slider, clients
  Mode: preview
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
// Create id attribute allowing for custom "anchor" value.
$id = 'dd-clients-carousel-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dd-clients-carousel';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$logos = 'logos';
@endphp

@if ( have_rows( $logos ) )
<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="glide {{ esc_attr($className) }}">
  <div data-glide-el="track" class="glide__track">
      <ul class="glide__slides">
      @while ( have_rows( $logos ) )
        @php the_row(); $logo = get_sub_field( 'logo' ); @endphp
          @if ( !empty( $logo ) )
            @php
            $url = $logo['url'];
            $alt = $logo['alt'];
            $ext = pathinfo( $url, PATHINFO_EXTENSION );
            @endphp
            <li class="glide__slide">
              @if ( $ext == 'svg' )
                @php echo file_get_contents( $url ); @endphp
              @else
                <img src="{{ $url }}" alt="{{ $alt }}">
              @endif
            </li>
          @endif
      @endwhile
      </ul>
  </div>
</section>
@endif
