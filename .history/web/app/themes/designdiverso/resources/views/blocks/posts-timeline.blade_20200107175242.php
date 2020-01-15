{{--
  Title: Posts Timeline
  Description: Posts Timeline
  Category: dd-blocks
  Icon: calendar
  Keywords: post, posts, timeline
  Mode: preview
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
// Create id attribute allowing for custom "anchor" value.
$id = 'dd-posts-timeline-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dd-posts-timeline';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$filter_categories = get_categories();

$args = array(
        'post_type' => 'post',
        'posts_per_page' => -1
    );

$posts_query = new WP_Query($args);
@endphp

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}">

@if( $filter_categories )
<select class="md:px-8 mb-8">
@foreach ($filter_categories as $category )
  <option value="{{$category->slug}}">{{ $category->name }}</a>
@endforeach
</select>
@endif

<div class="flex flex-wrap">
@while ($posts_query->have_posts())
@php
$posts_query->the_post();
$title = get_the_title();
$image = get_the_post_thumbnail_url();
$categories = get_the_category( get_the_ID() );
$link = get_the_permalink();
$category_classes = '';
@endphp
@if( is_array($categories) )
@foreach ( $categories as $category )
@php $category_classes .= $category->slug.' '; @endphp
@endforeach
@endif
  <div class="dd-posts-timeline__items__item dd-posts-timeline__items__item--visible {{ $category_classes }}">
    <h3>{{ $title }}</h3>
    <img src="{{ $image }}" alt="{{ $title }}">
  </div>
@endwhile
</div>
</section>

<script>

(function($) {
  $('.dd-posts-timeline__items__item:odd').each(function (i) {
      $(this).addClass('dd-posts-timeline__items__item--margin');
  });

  $(function(){
    $('.dd-posts-timeline__filter__link').click(function(){


      var value = $(this).attr('data-filter');
      var items = $('.dd-posts-timeline__items__item');
      var match = items.filter('.'+value);

      console.log(match);

      items.not('.'+value).removeClass('dd-posts-timeline__items__item--margin dd-posts-timeline__items__item--visible').hide(400);
      match.filter(':odd').addClass('dd-posts-timeline__items__item--margin');
      match.filter(':even').removeClass('dd-posts-timeline__items__item--margin');
      match.filter('.'+value).addClass('dd-posts-timeline__items__item--visible');
      match.filter('.'+value).show(400);
    });
  });
})(jQuery);
</script>
