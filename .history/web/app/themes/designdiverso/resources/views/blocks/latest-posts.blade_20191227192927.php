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
$id = 'hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dd-latest-posts-tweet';
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

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}>
  @foreach ($posts as $post)
    @php
    $image_url = get_the_post_thumbnail_url($post->ID);
    $title = $post->post_title;
    $author = get_the_author_meta('first_name', $post->post_author) . ' ' . get_the_author_meta('last_name', $post->post_author);
    $author_prefix = __('Written By ', 'sage');
    $read_more_link = get_the_permalink($post->ID);
    $read_more_text = __('Read More', 'sage');
    @endphp
    {{-- TODO: DRY --}}
    @if ($loop->iteration == 1)
      <div class="dd-latest-post">
        <div class="dd-latest-post__inner" style="background: url('{{ $image_url }}');'">
          <h3 class="text-white">{{  $title }}</h3>
          <div class="text-placeholder">{{ $author_prefix . $author }}</div>
          <a class="mt-2" href="{{ $read_more_link }}">{{ $read_more_text }}</a>
        </div>
      </div>
    @endif

    @if ($loop->iteration == 2)
      <div class="dd-latest-post">
        <div class="dd-latest-post__inner" style="background: url('{{ $image_url }}');'">
          <h3 class="text-white">{{  $title }}</h3>
          <div class="text-placeholder">{{ $author_prefix . $author }}</div>
          <a class="mt-2" href="{{ $read_more_link }}">{{ $read_more_text }}</a>
        </div>
      </div>
    @endif

    @if ($loop->iteration == 3)
      <div class="dd-latest-post">
        <div class="dd-latest-post__inner" style="background-image: url('{{ $image_url }}');">
          <h3 class="text-white">{{  $title }}</h3>
          <div class="text-placeholder">{{ $author_prefix . $author }}</div>
          <a class="mt-2" href="{{ $read_more_link }}">{{ $read_more_text }}</a>
        </div>
      </div>
    @endif
  @endforeach
      <div class="dd-latest-tweet">
        <div id="example3">
        </div>
        <a class="twitter-timeline" data-tweet-limit="1" data-height="202" data-chrome="noheader, nofooter, noborders, transparent, noscrollbar" href="https://twitter.com/designdiverso?ref_src=twsrc%5Etfw">Tweets by designdiverso</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
      </div>
</section>

