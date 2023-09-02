<link rel="stylesheet" href="{{ asset('css/rating.css') }}" type="text/css" media="all">
<div id="modal" role="dialog" aria-modal="true" aria-labelledby="add-review-header" class="">
    <button class="close-btn" aria-label="close" title="Close">x</button>
    <div id="review-form-container">
        <form id="review-form" method="post" action="{{url('/ratings')}}">
            @csrf
            <div class="fieldset">
                <label>Rating</label>
                <div class="rate">
                    <input type="radio" id="star5" name="star" value="5" onkeydown="navRadioGroup(event)" onfocus="setFocus(event)">
                    <label for="star5" title="5 stars">5 stars</label>
                    <input type="radio" id="star4" name="star" value="4" onkeydown="navRadioGroup(event)">
                    <label for="star4" title="4 stars">4 stars</label>
                    <input type="radio" id="star3" name="star" value="3" onkeydown="navRadioGroup(event)">
                    <label for="star3" title="3 stars">3 stars</label>
                    <input type="radio" id="star2" name="star" value="2" onkeydown="navRadioGroup(event)">
                    <label for="star2" title="2 stars">2 stars</label>
                    <input type="radio" id="star1" name="star" value="1" onkeydown="navRadioGroup(event)" onfocus="setFocus(event)" checked>
                    <label for="star1" title="1 star">1 star</label>
                </div>
            </div>

            <div class="fieldset">
                <label for="comment">Comments</label>
                <textarea name="comment" id="comment" cols="20" rows="5" required="" style="resize:none;"></textarea>
            </div>
            <div class="fieldset">
                <input type="submit" id="submit-review-btn" value="Send" />
            </div>
            <input type="hidden" id="order_id" name="order_id" value="">
        </form>
    </div>
</div>
<div class="modal-overlay"></div>
<script src="{{ asset('js/rating.js')}}"></script>
