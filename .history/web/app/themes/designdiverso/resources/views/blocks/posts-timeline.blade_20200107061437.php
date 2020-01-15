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

// Load values and assing defaults.
@endphp

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}">
  <h1>123</h1>
</section>
