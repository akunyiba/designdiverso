{{--
  Title: Hero
  Description: Hero section
  Category: dd-blocks
  Icon: slides
  Keywords: hero
  Mode: preview
  Align: wide
  PostTypes: page post
  SupportsAlign: false
  SupportsMode: false
  SupportsMultiple: false
--}}

@php
// Create id attribute allowing for custom "anchor" value.
$id = 'dd-hero-' . $block['id'];
if( !empty($block['anchor']) ) {
    $id = $block['anchor'];
}

// Create class attribute allowing for custom "className" and "align" values.
$className = 'dd-hero';
if( !empty($block['className']) ) {
    $className .= ' ' . $block['className'];
}
if( !empty($block['align']) ) {
    $className .= ' align' . $block['align'];
}

// Load values and assing defaults.
$image = get_field('image') ?: 295;
$text = get_field('text') ?: 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Laboriosam tempore autem temporibus animi consectetur impedit cumque adipisci delectus accusantium neque!';
$heading = get_field('heading') ?: 'Hero heading';
$button = get_field('button') ? : ['text' => 'Click here', 'link' => '#'];
$scroll = get_field('scroll') ? : ['icon' => '', 'target' => '#'];
@endphp

<section id="{{ esc_attr($id) }}" data-{{ esc_attr($id) }} class="{{ esc_attr($className) }}">
  <div class="dd-hero__inner">
    <div class="dd-hero__content">
        <h1 class="font-grotesk font-medium text-white text-h1 md:text-h1-md leading-08 md:leading-tight tracking-tight">{!! $heading !!}</h1>
        <p class="mt-10 text-white hidden md:block">{!! $text !!}</p>
        <button class="dd-btn dd-btn--primary mt-8">
          <a class="text-white" href="{{ $button['link'] }}">{{ $button['text'] }}</a>
        </button>
    </div>
  </div>
  <div class="hidden md:flex justify-center h-16">
    <a class="border-none" href="{{ '#' . $scroll['target'] }}">
        <img class="h-full" src="{{ wp_get_attachment_image_url($scroll['icon'], 'full') }}" alt="">
    </a>
  </div>
</section>

<style type="text/css">
[data-{{ esc_attr($id) }}] .dd-hero__inner {
  background-image: url({{ wp_get_attachment_image_url($image, 'full') }});
}
</style>
