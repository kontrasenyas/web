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
        var inputs = document.getElementsByClassName('location');

        var options = {
            types: ['(cities)'],
            componentRestrictions: {
                country: 'ph'
            }
        };

        var autocompletes = [];

        for (var i = 0; i < inputs.length; i++) {            
            if(inputs[i].nodeName != "INPUT")
            {
                inputs[i] = document.getElementById('post-location');
            }

            var autocomplete = new google.maps.places.Autocomplete(inputs[i], options);
            autocomplete.inputId = inputs[i].id;
            google.maps.event.addListener(autocomplete, 'place_changed', function(inputs) {
                var data = $("#" + this.inputId).serialize();
                if($("#" + this.inputId).nodeName != "INPUT")
                {
                    data = $("#post-location").serialize();
                }
                place = autocomplete.getPlace();

                return false;
            });
            autocompletes.push(autocomplete);
        }
    }
</script>

<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDzyfD_ElWBuNLUp-wubjovyY9ySNQSA94&libraries=places&callback=activatePlacesSearch" async defer></script>