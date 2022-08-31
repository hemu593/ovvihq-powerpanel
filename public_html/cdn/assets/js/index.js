// homepage client section
$(function() {
    // Owl Carousel
    var owl = $(".home-client .owl-carousel");
    owl.owlCarousel({
      items: 5,
      margin: 20,
      loop: true,
      dots: false,
      nav: true,
      autoplay: true,
      center:true,
      responsiveClass: true,
      responsive: {
          0: {
              items: 1,
          },
          480: {
              items: 2,
          },
          767: {
              items:3,
          },
          992: {
              items:4,
          },
          1366: {
              items: 5,           
          }
        }
    });
    $( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
    $( ".owl-next").html('<i class="fa fa-angle-right"></i>');
  });

// homepage Testimonial Section

$(function() {
  // Owl Carousel
  var owl = $(".home-testimonial .owl-carousel");
  owl.owlCarousel({
      items: 1,
      margin: 40,
      center:true,
      loop: true,
      autoplay: true,
      autoplayTimeout: 5000,
      nav: true,
      dots:false,
      responsiveClass:true
  });
  $( ".owl-prev").html('<i class="fa fa-angle-left"></i>');
  $( ".owl-next").html('<i class="fa fa-angle-right"></i>');
});