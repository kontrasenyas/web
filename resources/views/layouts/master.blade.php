<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" type="text/css" href="{{ URL::to('css/main.css') }}">

        <style type="text/css">
            body { padding-top: 70px; }
        </style>

    </head>
    <body>
        @include('includes/header')

        <div class="container">
          @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.0.0.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://code.jquery.com/jquery-migrate-3.0.0.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
 
        <script type="text/javascript" src="{{ URL::to('js/main.js')}}"></script> 
        
        {{-- For search autocomplete --}}
        {{-- <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script> 
        <script type="text/javascript">
            var path = "{{ route('search.location') }}";
            var data2 = null;
            var data3 = null;
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

            // $("#location").focus(function() {
            //  console.log('in');
            // }).blur(function() {
            //  console.log('out');
            // });  

        </script>
    </body>
</html>
