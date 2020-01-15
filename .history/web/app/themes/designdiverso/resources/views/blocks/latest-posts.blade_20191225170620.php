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
        'posts_per_page' => 3,
        'no_found_rows' => true
    );

$post_query = new WP_Query($args);
$posts = $post_query->get_posts();

// Load values and assing defaults.
@endphp

<section data-{{ $block['id'] }} class="dd-latest-posts relative flex flex-wrap {{ $block['classes'] }}">
  @foreach ($posts as $post)
    @if ($loop->iteration == 1)
      <h3>{{ $post->get_the_title() }}</h3>
    @endif

    @if ($loop->iteration == 2)
      <h3>{{ $post->get_the_title() }}</h3>
    @endif

    @if ($loop->iteration == 3)
      <h3>{{ $post->get_the_title() }}</h3>
    @endif
  @endforeach

  {{-- @if($post_query->have_posts())
  @while ($post_query->have_posts())
  @php
  $post_query->the_post();
  $title = get_the_title();
  $author = get_the_author_meta('first_name') . ' ' . get_the_author_meta('last_name');
  $author_prefix = __('Written By ', 'sage');
  $read_more_link = get_the_permalink();
  $read_more_text = __('Read More', 'sage');

  @endphp
    <div class="dd-latest-post w-1/2">
      <div class="dd-latest-post__inner" style="background: url('{{ get_the_post_thumbnail_url() }}');'">
        <h3 class="text-white">{{ $title }}</h3>
        <div class="text-placeholder">{{ $author_prefix . $author }}</div>
        <a href="{{ $read_more_link }}">{{ $read_more_text }}</a>
      </div>
    </div>
  @endwhile
  @endif
  @php wp_reset_postdata(); @endphp --}}
</section>

<style type="text/css">
/* [data-{{$block['id']}}] .dd-hero__inner {
  background-image: url({{ wp_get_attachment_image_url($image, 'full') }});
} */
.dd-latest-post {
  height: 240px;
}
.dd-latest-post__inner {
  height: 100%;
  background-size: cover;
}
.dd-latest-post:nth-of-type(1) {
  padding-right: 20px;
}
.dd-latest-post:nth-of-type(2) {
  align-self: flex-end;
  margin-top: 174px;
  padding-left: 20px;
}
.dd-latest-post:nth-of-type(3) {
  margin-top: -87px;
  padding-right: 20px;
}
</style>
