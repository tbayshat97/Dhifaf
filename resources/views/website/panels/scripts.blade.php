<!-- jquery plugins here-->
<script src="{{asset('website/js/jquery-1.12.1.min.js')}}"></script>
<!-- popper js -->
<script src="{{asset('website/js/popper.min.js')}}"></script>
<!-- bootstrap js -->
<script src="{{asset('website/js/bootstrap.min.js')}}"></script>
<!-- easing js -->
<script src="{{asset('website/js/jquery.magnific-popup.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('website/js/swiper.min.js')}}"></script>
<!-- swiper js -->
<script src="{{asset('website/js/masonry.pkgd.js')}}"></script>
<!-- particles js -->
<script src="{{asset('website/js/owl.carousel.min.js')}}"></script>
<script src="{{asset('website/js/jquery.nice-select.min.js')}}"></script>
<!-- slick js -->
<script src="{{asset('website/js/slick.min.js')}}"></script>
<script src="{{asset('website/js/jquery.counterup.min.js')}}"></script>
<script src="{{asset('website/js/waypoints.min.js')}}"></script>
<script src="{{asset('website/js/contact.js')}}"></script>
<script src="{{asset('website/js/jquery.ajaxchimp.min.js')}}"></script>
<script src="{{asset('website/js/jquery.form.js')}}"></script>
<script src="{{asset('website/js/jquery.validate.min.js')}}"></script>
<script src="{{asset('website/js/mail-script.js')}}"></script>
<script src="/js/app.js"></script>
<!-- custom js -->
{{-- <script src="{{asset('website/js/custom.js')}}"></script> --}}

<script>

// Search Toggle
  $("#search_input_box").hide();
  $("#search_1").on("click", function () {
    $("#search_input_box").show();
    $("#search_input").focus();
  });
  $("#close_search").on("click", function () {
    $('#search_input_box').hide();
  });

$(function() { 
  $(".search-modal").click(function() {
      $("#search").addClass("show");
  });
  $("#close-search").click(function() {
      $("#search").removeClass("show");
  });
});


$(window).scroll(function() {    
  var scroll = $(window).scrollTop();
  if (scroll >= 1) {
    $("header").addClass("sticky-header");
  }
  else {
    $("header").removeClass("sticky-header");
  }
});

</script>

@stack('scripts')