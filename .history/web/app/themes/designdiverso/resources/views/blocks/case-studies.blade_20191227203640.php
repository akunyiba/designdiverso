{{--
  Title: Case Studies
  Description: Case Studies
  Category: dd-blocks
  Icon: portfolio
  Keywords: case study, case studies, portfolio
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
$className = 'dd-case-studies';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

$categories = get_terms(array(
    'taxonomy' => 'case_study_category',
    'hide_empty' => false,
));

$args = array(
        'post_type' => 'case_study',
        'posts_per_page' => -1
    );

$case_studies_query = new WP_Query($args);
@endphp

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}">

@if( $categories )
<div class="px-8 mb-8">
@foreach ($categories as $category )
   <a
   class="dd-case-studies__filter__link {{ !$loop->first ? 'dd-case-studies__filter__link--separator' : '' }}"
   href="javascript:;"
   data-filter="{{ $category->slug }}">{{ $category->name }}</a>
@endforeach
</div>
@endif

<div class="flex flex-wrap">
@while ($case_studies_query->have_posts())
@php
$case_studies_query->the_post();
$title = get_the_title();
$image = get_the_post_thumbnail_url();
$categories = get_the_terms( get_the_ID(), 'case_study_category' );;
$category_singular_name = $categories[0]->description;
$link = get_the_permalink();
@endphp
  <div class="dd-case-studies__items__item w-1/2 px-8 mb-16">
    <h3>{{ $title }}</h3>
    <img src="{{ $image }}" alt="{{ $title }}">
    <a class="text-black font-proxima" href="{{ $link }}">{{ __('View ', 'sage') . $category_singular_name }}</a>
  </div>
@endwhile
</div>
</section>
