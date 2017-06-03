<!-- Modal -->
<div id="momentModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">What is your travel Moment?</h4>
            </div>
            <form action="{{ route('moment.create') }}" method="post"  enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                        <textarea class="form-control" data-min-rows='2' placeholder="Share with us your travel experience." aria-describedby="basic-addon2" name="body" id="body" value="{{ Request::old('body') }}">{{ Request::old('body') }}</textarea>
                    </div>
                    <div class="form-group {{ $errors->has('location') ? 'has-error' : '' }}">
                        <input type="text" class="form-control typeahead" autocomplete="off" data-min-rows='2' placeholder="Where did this happen?" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('body') }}">
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image">Upload a photo</label>
                        <input type="file" name="image" class="form-control" id="image">
                    </div>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Post</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div id="momentModalClose" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Leave Page?</h4>
            </div>
            <div class="modal-body">
                You haven't finished your travel moment yet. Do you want to leave without finishing?
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary" onclick="clearData()">Okay</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" onclick="openMomentModal()">Cancel</button>
            </div>
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">
        @if (count($errors) > 0)
        $('#momentModal').modal('show');
        @endif
    </script>

    <script type="text/javascript">
        $('textarea').each(function () {
            this.setAttribute('style', 'height:' + (this.scrollHeight) + 'px;overflow-y:hidden;');
        }).on('input', function () {
            this.style.height = 'auto';
            this.style.height = (this.scrollHeight) + 'px';
        });

        $('#btnMoment').on("click", function(e){
            $("#body").height(20);
        });

        $('#momentModal').on('hidden.bs.modal', function (e) {
            var $body = $('#body').val();
            if($body != "")
            {
                $('#momentModalClose').modal('show')
            }
        });

        function clearData()
        {
            $('#momentModal')
                .find("textarea,select")
                .val('')
                .end()

            momentModalClose();
        }

        function openMomentModal()
        {
            $('#momentModal').modal('show');
        }

        function momentModalClose()
        {
            $('#momentModalClose').modal('hide');
        }
    </script>

    @include('includes.places-autocomplete')

@endsection