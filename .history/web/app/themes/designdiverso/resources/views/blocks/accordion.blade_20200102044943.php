{{--
  Title: Accordion
  Description: Accordion
  Category: dd-blocks
  Icon: list-view
  Keywords: accordion
  Mode: preview
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
// Create id attribute allowing for custom "anchor" value.
$id = 'dd-accordion-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dd-accordion';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$rows = get_field('accordion');
@endphp

@if ($rows)
<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="glide {{ esc_attr($className) }}">
  @foreach ($rows as $item)
    <pre>{{ $item }}</pre>
  @endforeach
</section>
@endif

<h1>xx</h1>

