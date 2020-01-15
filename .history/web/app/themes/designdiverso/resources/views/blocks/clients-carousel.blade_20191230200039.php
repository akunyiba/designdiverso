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
$id = 'clients-carousel-' . $block['id'];
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
$logos = get_field('logos') ?: [];
@endphp

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="bg-black {{ esc_attr($className) }}">
@foreach ($logos as $logo)
  {{-- <img src="{{ $logo['logo']['url'] }}" alt="{{ $logo['logo']['alt'] }}"> --}}
  <div class="logo">
    {{ $logo['logo']['url'] }}
  </div>
@endforeach
</section>

{{-- <pre>@php print_r($logos) @endphp</pre> --}}
