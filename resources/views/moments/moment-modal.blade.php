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
                        <input type="text" class="form-control" autocomplete="off" data-min-rows='2' placeholder="Where did this happen?" aria-describedby="basic-addon2" name="location" id="location" value="{{ Request::old('location') }}">
                    </div>
                    <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                        <label for="image">Upload your best shot</label>
                        {{-- <input type="file" name="image" class="form-control" id="image"> --}}
                        <input name="image" id="input-id" type="file" class="dropify" data-preview-file-type="text">
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
