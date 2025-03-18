<script src="{{asset('frontend/js/jquery-latest.js')}}"></script>
<script src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
<script src="{{asset('frontend/js/modernizr.custom.js')}}"></script>

<script src="{{asset('frontend/assets/rendro-easy-pie-chart/dist/jquery.easypiechart.min.js')}}"></script>

<script src="{{asset('frontend/js/jquery.easypiechart.min.js')}}"></script>
<script src="{{asset('frontend/js/classie.js')}}"></script>

<!--Switcher-->
<script src="{{asset('frontend/assets/switcher/js/switcher.js')}}"></script>
<!--Owl Carousel-->
<script src="{{asset('frontend/assets/owl-carousel/owl.carousel.min.js')}}"></script>
<!--bxSlider-->
<script src="{{asset('frontend/assets/bxslider/jquery.bxslider.js')}}"></script>
<!-- jQuery UI Slider -->
<script src="{{asset('frontend/assets/slider/jquery.ui-slider.js')}}"></script>

<!--Theme-->
<script src="{{asset('frontend/js/jquery.smooth-scroll.js')}}"></script>
<script src="{{asset('frontend/js/wow.min.js')}}"></script>
<script src="{{asset('frontend/js/jquery.placeholder.min.js')}}"></script>
<script src="{{asset('frontend/js/toastr.min.js')}}"></script>

<script src="{{asset('frontend/js/theme.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js" ></script>

<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
    source: function(query, process) {
        return $.get(path, { query: query }, function(data) {
            var names = data.map(function(item) {
                console.log(item); 
                return item.brand_name;  // Extract name or the property you want
            });
            // Inspect the structure of the response
            return process(names);
        });
    }
});

</script>

</body>

</html>