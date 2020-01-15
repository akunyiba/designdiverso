{{--
  Title: Latest Posts
  Description: Latest Posts
  Category: dd-blocks
  Icon: grid-view
  Keywords: posts, blog
  Mode: preview
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
// Create id attribute allowing for custom "anchor" value.
// $id = 'hero-' . $block['id'];
// if( !empty($block['anchor']) ) {
//     $id = $block['anchor'];
// }

// Create class attribute allowing for custom "className" and "align" values.
$className = 'hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$args = array(
        'post_type' => 'post',
        'posts_per_page' => 2,
        'no_found_rows' => true
    );

$post_query = new WP_Query($args);

// Load values and assing defaults.
@endphp

<section data-{{ $block['id'] }} class="dd-latest-posts {{ $block['classes'] }}">
  @if($post_query->have_posts())
  @while ($post_query->have_posts()) @php $post_query->the_post() @endphp
    @php the_title() @endphp
  @endwhile
  @endif
  @php wp_reset_postdata(); @endphp
</section>

{{-- <style type="text/css">
[data-{{$block['id']}}] .dd-hero__inner {
  background-image: url({{ wp_get_attachment_image_url($image, 'full') }});
}
</style> --}}
