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
// $id = 'hero-' . $block['id'];
// if( !empty($block['anchor']) ) {
//     $id = $block['anchor'];
// }

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

<section data-{{ $block['id'] }} class="{{ $block['classes'] }}">

@if( $categories )
<div class="dd-case-studies__filter">
@foreach ($categories as $category )
   <a
   class="dd-case-studies__filter__link {{ !$loop->first ? 'dd-case-studies__filter__link--separator' : '' }}"
   href="javascript:;"
   data-filter="{{ $category->slug }}">{{ $category->name }}</a>
@endforeach
</div>
@endif

@while ($case_studies_query->have_posts()) 
@php 
$case_studies_query->the_post();
$title = get_the_title();
$image = get_the_post_thumbnail_url();
@endphp
  <div class="dd-case-studies__study">
    <h3>{{ $title }}</h3>
    <img src="{{ $image }}" alt="">
    <a href="#">{{ __('View ', 'sage') }}</a>
  </div>
@endwhile

</section>
