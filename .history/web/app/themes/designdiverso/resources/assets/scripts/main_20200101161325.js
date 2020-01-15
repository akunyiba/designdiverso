// import external dependencies
import 'jquery';

// Import everything from autoload
import './autoload/**/*'

// import local dependencies
import Router from './util/Router';
import common from './routes/common';
import home from './routes/home';
import aboutUs from './routes/about';

// import Glide slider
import Glide from '@glidejs/glide';

/** Populate Router instance with DOM routes */
const routes = new Router({
  // All pages
  common,
  // Home page
  home,
  // About Us page, note the change from about-us to aboutUs.
  aboutUs,
});

// Load Events
jQuery(document).ready(() => routes.loadEvents());

// Initialize Glide slider
// new Glide('.glide').mount();
new Glide('.glide', {
  autoplay: 4000,
  perView: 3,
}).mount();

//TODO: Move?
$(document).ready(function () {
  // Smooth scroll
  $('a[href^="#"]').click(function () {
    $('html, body').animate({
      scrollTop: $($.attr(this, 'href')).offset().top,
    }, 500);
    return false;
  });

  // menu click event
  $('.dd-hamburger').click(function () {
    $(this).toggleClass('act');
    if ($(this).hasClass('act')) {
      $('.nav-primary').addClass('act');
    }
    else {
      $('.nav-primary').removeClass('act');
    }
  });
});
