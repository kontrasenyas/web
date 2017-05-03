@extends('layouts.master')

@section('title')
    Feedback for {{ $user->first_name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4 text-center">
            @if((Auth::user() && (Auth::user() && (Auth::user()->id != $user->id))) || (!Auth::user()))
                <h3>Feedback to <a
                            href="{{ route('account.profile', ['id' => $user->id]) }}"> {{ $user->first_name }} {{ $user->last_name }} </a>
                </h3>
                <hr>
            @endif
            @if(Auth::user() && (Auth::user() && (Auth::user()->id == $user->id)))
                <h3>Your Feedback
                </h3>
            @endif
            @if(Auth::user() && (Auth::user() && (Auth::user()->id != $user->id)))
                <input type="hidden" class="rating"/>
                <form action="{{ route('account.review-post') }}" method="post">
                    <div class="row lead">
                        <div id="hearts-existing" class="starrr" data-rating='0' style="color: #ee8b2d;"></div>
                        You gave a rating of <span id="count-existing" name="star">0</span> star(s)
                        <input class="form-control" type="hidden" name="rating" id="rating">
                    </div>
                    <div class="form-group {{ $errors->has('comment') ? 'has-error' : '' }}">
                        <label for="comment">Comment</label>
                        <textarea class="form-control" type="text" name="comment" id="comment"
                                  value="{{ Request::old('comment') }}"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();">Send
                        Feedback
                    </button>
                    <input type="hidden" name="_token" value="{{ Session::token() }}">
                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                </form>
            @endif
            @if(!Auth::user())
                Please <a href="{{ route('login') }}">login</a>  or <a href="{{ route('register') }}">register</a> to
                provide a feedback to this user. Thank you.
            @endif
            <hr>
        </div>
        <div class="col-md-4 col-md-offset-4">
            <h4>Reviews</h4>
            @if(count($reviews) > 0)
                <div class="col-md-12"> <p class="info">There are <strong>{{ $reviews->total() }}</strong> reviews for this user. </p></div>
                @foreach($reviews as $review)
                    <div class="form-group div_hover col-md-12" title="View user profile">
                        <div class="col-md-12">
                            <a href="{{ route('account.profile', ['$id' => $review->user->id]) }}"><h5>
                                    <strong>{{ $review->user->first_name }} {{ $review->user->last_name }}</strong></h5>
                            </a>
                        </div>
                        <div class="col-md-12">
                            <p><em>{{ $review->comment }}</em></p>
                            <p class="small">{{ $review->created_at->diffForHumans() }}</p>
                        </div>

                    </div>
                @endforeach
            @endif
            @if(count($reviews) == 0)
                <div class="col-md-12">
                    <p><em>There is no feedback for this user.</em></p>
                </div>
            @endif
        </div>
    </div>
    <div class="text-center">
        {{ $reviews->appends(Request::except('page'))->links() }}
    </div>
@endsection

@section('script')
<script type="text/javascript">
    // Starrr plugin (https://github.com/dobtco/starrr)
    var __slice = [].slice;

    (function($, window) {
        var Starrr;

        Starrr = (function() {
            Starrr.prototype.defaults = {
                rating: void 0,
                numStars: 5,
                change: function(e, value) {}
            };

            function Starrr($el, options) {
                var i, _, _ref,
                    _this = this;

                this.options = $.extend({}, this.defaults, options);
                this.$el = $el;
                _ref = this.defaults;
                for (i in _ref) {
                    _ = _ref[i];
                    if (this.$el.data(i) != null) {
                        this.options[i] = this.$el.data(i);
                    }
                }
                this.createStars();
                this.syncRating();
                this.$el.on('mouseover.starrr', 'span', function(e) {
                    return _this.syncRating(_this.$el.find('span').index(e.currentTarget) + 1);
                });
                this.$el.on('mouseout.starrr', function() {
                    return _this.syncRating();
                });
                this.$el.on('click.starrr', 'span', function(e) {
                    return _this.setRating(_this.$el.find('span').index(e.currentTarget) + 1);
                });
                this.$el.on('starrr:change', this.options.change);
            }

            Starrr.prototype.createStars = function() {
                var _i, _ref, _results;

                _results = [];
                for (_i = 1, _ref = this.options.numStars; 1 <= _ref ? _i <= _ref : _i >= _ref; 1 <= _ref ? _i++ : _i--) {
                    _results.push(this.$el.append("<span class='glyphicon .glyphicon-star-empty'></span>"));
                }
                return _results;
            };

            Starrr.prototype.setRating = function(rating) {
                if (this.options.rating === rating) {
                    rating = void 0;
                }
                this.options.rating = rating;
                this.syncRating();
                return this.$el.trigger('starrr:change', rating);
            };

            Starrr.prototype.syncRating = function(rating) {
                var i, _i, _j, _ref;

                rating || (rating = this.options.rating);
                if (rating) {
                    for (i = _i = 0, _ref = rating - 1; 0 <= _ref ? _i <= _ref : _i >= _ref; i = 0 <= _ref ? ++_i : --_i) {
                        this.$el.find('span').eq(i).removeClass('glyphicon-star-empty').addClass('glyphicon-star');
                    }
                }
                if (rating && rating < 5) {
                    for (i = _j = rating; rating <= 4 ? _j <= 4 : _j >= 4; i = rating <= 4 ? ++_j : --_j) {
                        this.$el.find('span').eq(i).removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                    }
                }
                if (!rating) {
                    return this.$el.find('span').removeClass('glyphicon-star').addClass('glyphicon-star-empty');
                }
            };

            return Starrr;

        })();
        return $.fn.extend({
            starrr: function() {
                var args, option;

                option = arguments[0], args = 2 <= arguments.length ? __slice.call(arguments, 1) : [];
                return this.each(function() {
                    var data;

                    data = $(this).data('star-rating');
                    if (!data) {
                        $(this).data('star-rating', (data = new Starrr($(this), option)));
                    }
                    if (typeof option === 'string') {
                        return data[option].apply(data, args);
                    }
                });
            }
        });
    })(window.jQuery, window);

    $(function() {
        return $(".starrr").starrr();
    });

    $( document ).ready(function() {

        $('#hearts').on('starrr:change', function(e, value){
            $('#count').html(value);
        });

        $('#hearts-existing').on('starrr:change', function(e, value){
            $('#count-existing').html(value);
        });
    });

    $('.starrr').on('starrr:change', function(e, value){
        $("#rating").val(value);
    })
</script>

@endsection