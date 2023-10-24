{{-- @extends('layouts.app') --}}
@include('layouts.include.style')

<!-- Topbar Start -->
@include('frontend.topbar')
<!-- Topbar End -->

<div class="container-fluid pt-5">
    <livewire:frontend.product.view :category="$category" :products="$products" />

    @livewireStyles
    @livewireScripts
    @if ($userHasBoughtProduct)
    <div class="container">
        <div class="row">
            <div class="col mt-4">
                <form class="py-2 px-4" action="{{ route('review.store', ['product_id' => $id]) }}"
                    style="box-shadow: 0 0 10px 0 #ddd;" method="POST" autocomplete="off">
                    @csrf
                    <p class="font-weight-bold ">Review</p>
                    <div class="form-group row">
                        <div class="col">
                            <div class="rate">

                                <input type="radio" id="star5" class="rate" name="rating" value="5" />
                                <label for="star5" title="Excellent">☆☆☆☆☆</label>

                                <input type="radio" id="star4" class="rate" name="rating" value="4" />
                                <label for="star4" title="Good">☆☆☆☆</label>

                                <input type="radio" id="star3" class="rate" name="rating" value="3" />
                                <label for="star3" title="Average">☆☆☆</label>

                                <input type="radio" id="star2" class="rate" name="rating" value="2" />
                                <label for="star2" title="Below Average">☆☆</label>

                                <input type="radio" id="star1" class="rate" name="rating" value="1" />
                                <label for="star1" title="Poor">☆</label>

                            </div>
                        </div>
                    </div>

                    <div class="form-group row mt-4">
                        <div class="col">
                            <textarea class="form-control" name="comment" rows="6 " placeholder="Comment" maxlength="200"></textarea>
                        </div>
                    </div>

                    <div class="mt-3 text-right">
                        <button class="btn btn-sm py-2 px-3 btn-info">Submit
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
    @endif

    <div class="container">
        <h4>Customer's Reviews</h4>
        <div class="comment-section">
            @foreach ($rev as $review)
                @if ($review->product_id == $id)
                    <div class="card2 p-3">

                        <div class="review">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="user d-flex flex-row align-items-center">
                                    @php
                                    try {
                                        $customerImages = $review->user->customer->images ?? [];

                                        $firstImage = isset($customerImages[0]) ? $customerImages[0] : '';
                                        $imagePath = $firstImage ? asset('storage/' . $firstImage) : null;
                                    } catch (\Exception $e) {
                                        $imagePath = null;
                                    }
                                @endphp
                                @if ($imagePath)
                                    <br>
                                    <img src="{{ $imagePath }}" alt="Customer Image" class="user-img rounded-circle mr-2" width="50px">
                                @else
                                    <p>No customer image available.</p>
                                @endif
                                                    
                                    <span>
                                        <small class="font-weight-bold text-primary">{{ $review->user->name }}</small>
                                    </span>
                                </div>
                                @if (Auth::check() && Auth::user()->id === $review->user_id)
                                    <div class="review-actions">
                                        <a href="{{ route('review.edit', ['id' => $review->user->id]) }}"
                                            data-toggle="modal" data-target="#editModal{{ $review->id }}"
                                            class="edit-review">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <form id="delete-form-{{ $review->review_id }}"
                                            action="{{ route('review.destroy', ['id' => $review->review_id]) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-link text-danger delete-review-button"
                                                onclick="return confirm('Are you sure you want to delete this review?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>
                                @endif

                                
                            </div>
                            <div class="review-details">
                                <div class="star-rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $review->rate)
                                            <i class="fas fa-star filled"></i>
                                        @else
                                            <i class="far fa-star"></i>
                                        @endif
                                    @endfor
                                </div>
                                <p class="review-comment">{{ $review->comment }}</p>
                            </div>
                        </div>

                    </div>
                    <div class="modal fade" id="editModal{{ $review->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="editModalLabel{{ $review->id }}" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="editModalLabel{{ $review->id }}">Edit Review</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ route('review.update', ['id' => $review->product_id, 'product_id' => $review->review_id]) }}"
                                        method="POST" autocomplete="off">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group">
                                            <label for="rating">Rating</label>
                                            <br>
                                            <div class="col">
                                                <div class="rate">
                                                    <input type="radio" id="star5-{{ $review->id }}"
                                                        class="rate" name="rating" value="5" />
                                                    <label for="star5-{{ $review->id }}"
                                                        title="Excellent">☆☆☆☆☆</label>

                                                    <input type="radio" id="star4-{{ $review->id }}"
                                                        class="rate" name="rating" value="4" />
                                                    <label for="star4-{{ $review->id }}"
                                                        title="Good">☆☆☆☆</label>

                                                    <input type="radio" id="star3-{{ $review->id }}"
                                                        class="rate" name="rating" value="3" />
                                                    <label for="star3-{{ $review->id }}"
                                                        title="Average">☆☆☆</label>

                                                    <input type="radio" id="star2-{{ $review->id }}"
                                                        class="rate" name="rating" value="2" />
                                                    <label for="star2-{{ $review->id }}"
                                                        title="Below Average">☆☆</label>

                                                    <input type="radio" id="star1-{{ $review->id }}"
                                                        class="rate" name="rating" value="1" />
                                                    <label for="star1-{{ $review->id }}" title="Poor">☆</label>
                                                </div>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="form-group">
                                            <br>
                                            <label for="comment">Comment</label>
                                            <br>
                                            <textarea class="form-control" id="comment" name="comment" rows="4">{{ $review->comment }}</textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
</div>

<!-- Footer Start -->
@include('frontend.footer')
<!-- Footer End -->

<!-- Back to Top -->
<a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>

@include('layouts.include.scripts')
