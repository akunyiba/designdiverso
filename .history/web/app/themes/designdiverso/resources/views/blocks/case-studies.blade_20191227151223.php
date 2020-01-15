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
@endphp

@if( $categories )
@foreach ($categories as $category )
   <a
   class="dd-case-study-filter__link  {{ !$loop->first ? 'dd-case-study-filter__link--separator' : ''}}"
   href="javascript:;"
   data-filter="{{ $category->slug }}">{{ $category->name }}</a>
@endforeach
@endif
