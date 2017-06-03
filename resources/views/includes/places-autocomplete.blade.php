<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
<script type="text/javascript">
    var path = "{{ route('search.location') }}";
    $('input.typeahead').typeahead({
        minLength: 1,
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        }
    });

    var $input = $(".typeahead");
    $input.change(function() {
        var current = $input.typeahead("getActive");
        if (current) {
            if (current.name == $input.val()) {
                console.log('2');
            } else {
                $('#location').val("");
            }
        } else {
            $('#location').val("");
        }
    });
</script>