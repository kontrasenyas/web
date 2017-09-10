{{-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-growl/1.0.0/jquery.bootstrap-growl.min.js"></script> --}}
    <!-- Init JavaScript -->
    <script src="vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js"></script>

@if(isset($errors) && count($errors) > 0)
<script type="text/javascript">
 	$(document).ready( function () {
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            heading: 'Opps! somthing wents wrong',
            text: '<ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>',
            position: 'top-right',
            loaderBg:'#f2b701',
            icon: 'error',
            hideAfter: 3500
        });
        return false;
    });
</script>
@endif

@if(Session::has('message'))
<script type="text/javascript">
    $(document).ready( function () {
        $.toast().reset('all');
        $("body").removeAttr('class');
        $.toast({
            //heading: 'Welcome to Magilla',
            text: '{{ Session::get('message') }}',
            position: 'top-right',
            loaderBg:'#f2b701',
            icon: 'success',
            hideAfter: 3500, 
            stack: 6
          });
        return false;  
    });
</script>
@endif

