{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>--}}
{{--<script type="text/javascript">--}}
    {{--var path = "{{ route('search.location') }}";--}}
    {{--$('input.typeahead').typeahead({--}}
        {{--minLength: 1,--}}
        {{--source:  function (query, process) {--}}
            {{--return $.get(path, { query: query }, function (data) {--}}
                {{--return process(data);--}}
            {{--});--}}
        {{--}--}}
    {{--});--}}

    {{--var $input = $(".typeahead");--}}
    {{--$input.change(function() {--}}
        {{--var current = $input.typeahead("getActive");--}}
        {{--if (current) {--}}
            {{--if (current.name == $input.val()) {--}}
                {{--console.log('2');--}}
            {{--} else {--}}
                {{--$('#location').val("");--}}
            {{--}--}}
        {{--} else {--}}
            {{--$('#location').val("");--}}
        {{--}--}}
    {{--});--}}
{{--</script>--}}

{{--For modal--}}
<style type="text/css">
    .pac-container {
        z-index: 100000;
    }
</style>

 {{--Google Places Autocomplete--}}
<script type="text/javascript">
    var place;

    function activatePlacesSearch(){
        var input = document.getElementById('location');

        if(input.nodeName != "INPUT")
        {
            input = document.getElementById('post-location');
        }
       // var autocomplete = new google.maps.places.Autocomplete(input);

        //$location_input = $("#location");
//        var options = {
//            types: ['(cities)'],
//            componentRestrictions: {
//                country: 'be'
//            }
//        };
        autocomplete = new google.maps.places.Autocomplete(input);
            
        google.maps.event.addListener(autocomplete, 'place_changed', function() {
            var data = $("#location").serialize();
            if(input.nodeName != "INPUT")
            {
                data = $("#post-location").serialize();
            }
            place = autocomplete.getPlace();



            // if (!place.geometry) {
            //     // User entered the name of a Place that was not suggested and
            //     // pressed the Enter key, or the Place Details request failed.
            //     $("#location").val('');
            //     window.alert("Please enter valid location");
            //     return;
            // }

            return false;
        });

    }
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzyfD_ElWBuNLUp-wubjovyY9ySNQSA94&libraries=places&callback=activatePlacesSearch" async defer></script>