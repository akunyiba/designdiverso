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
<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}">
  @foreach ($rows as $item)
  @php
     $title = $item['title'];
     $text = $item['text'];
  @endphp
  <div class="dd-accordion__item">
    <h4 class="text-white"><a href="javascript;" class="text-white">{{ $title }}</a></h4>
    <div class="dd-accordion__item__text">
      <p class="text-white">{{ $text }}</p>
    </div>
  </div>
  @endforeach
</section>
@endif

<script>
(function($) {
  $(function(){
    $('.dd-accordion__item__text').hide();
    $('.dd-accordion__item').click(function() {
      $(this).children('.dd-accordion__item__text').slideToggle(500);
      $(this).toggleClass('dd-accordion__item--selected');
    });
  });
})(jQuery);
</script>


