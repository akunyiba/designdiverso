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
<div class="dd-posts-timeline__filter">
  <span class="dd-posts-timeline__filter-text">{{ __('I  want  to  learn  about ', 'sage') }}</span>
  <div class="dd-posts-timeline__filter-menu">
    <a class="dd-posts-timeline__filter-menu-link-everything" data-filter="everything" href="javascript:;">{{ __( 'everything', 'sage' ) }}</a>
    <ul class="hidden">
      @foreach ($filter_categories as $category )
        <li><a class="dd-posts-timeline__filter-menu-link" href="javascript:;" data-filter="{{$category->slug}}">{{ $category->name }}</a></li>
      @endforeach
    </ul>
  </div>
</div>
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
  <div class="dd-posts-timeline__item dd-posts-timeline__item--visible {{ $category_classes }}">
    <div class="dd-posts-timeline__item-inner">
        <img src="{{ $image }}" alt="{{ $title }}">
        <h4 class="mt-2 mb-0">{{ $title }}</h4>
    </div>
  </div>
@endwhile
</div>
</section>

<script>

(function($) {
  $('.dd-posts-timeline__item:odd').each(function (i) {
      $(this).addClass('dd-posts-timeline__item--margin');
  });

  $(function(){

    $(document).on("click", function(event){
        if(!$(event.target).closest('.dd-posts-timeline__filter-menu').length){
            $('.dd-posts-timeline__filter-menu ul').fadeOut('fast');
        }
    });

    $('.dd-posts-timeline__filter-menu-link-everything').click(function(){
      $(this).next('ul').fadeToggle('fast');
      $(this).toggleClass('dd-posts-timeline__filter-menu-link-everything--clicked');

      // $(this).toggleClass('dd-posts-timeline__filter-menu-everything-link--active');
    });

    $('.dd-posts-timeline__filter-menu-link, .dd-posts-timeline__filter-menu-link-everything').click(function(){
      var links = $('.dd-posts-timeline__filter-menu-link, .dd-posts-timeline__filter-menu-link-everything');
      links.removeClass('dd-posts-timeline__filter-menu-link--active')
      $(this).addClass('dd-posts-timeline__filter-menu-link--active');
    });

    $('.dd-posts-timeline__filter-menu-link, .dd-posts-timeline__filter-menu-link-everything').click(function(){

      var value = $(this).attr('data-filter');
      var items = $('.dd-posts-timeline__item');

      if( value && value !== 'everything' ){
        var match = items.filter('.'+value);

        items.not('.'+value).removeClass('dd-posts-timeline__item--margin dd-posts-timeline__item--visible').hide(400);
        match.filter(':odd').addClass('dd-posts-timeline__item--margin');
        match.filter(':even').removeClass('dd-posts-timeline__item--margin');
        match.filter('.'+value).addClass('dd-posts-timeline__item--visible');
        match.filter('.'+value).show(400);
      }
      else if( value && value == 'everything' ) {
        items.filter(':odd').addClass('dd-posts-timeline__item--margin');
        items.filter(':even').removeClass('dd-posts-timeline__item--margin');
        items.addClass('dd-posts-timeline__item--visible').show(400);
      }
    });
  });
})(jQuery);
</script>
