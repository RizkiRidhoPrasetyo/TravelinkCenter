@extends('frontend.layouts')

@section('content')
<div class="container-fluid p-0">
    <img src="{{ asset('assets/images/headertopdes.png') }}" class="img-fluid w-100" alt="Top Destinations Header">
</div>

<div class="container-fluid bg-light" style="margin-top: -20px; position: sticky; top: 0; z-index: 1030;"> <!-- Menambahkan posisi sticky agar navbar tetap mengambang saat scroll -->
    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <a class="navbar-brand" href="#">Top Destination</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#dealsNavbar"
                aria-controls="dealsNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="dealsNavbar">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#">Wisata</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Kuliner</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Penginapan</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<div class="container py-5">
    <h2 class="text-center fw-bold mb-4">Top Destinations</h2>
    <div class="row g-4">
        @foreach($topDestinations as $destination)
        <div class="col-md-3 mb-4"> <!-- Applied consistent styling from Club section -->
            <div class="card border-0 shadow-sm h-100 position-relative">
                <img src="{{ Storage::url($destination->images[0] ?? 'default.jpg') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $destination->name }}">
                <div class="card-body text-center">
                    <h5 class="card-title">{{ $destination->name }}</h5>
                    <p class="card-text">{{ $destination->region }}</p>
                    <div class="position-absolute" style="top: 50%; right: 0; transform: translateY(-50%); background-color: #FFD700; padding: 10px; border-radius: 5px;"> <!-- Promo Price overlay -->
                        <span style="font-weight: bold; color: #2D2766;">Promo Price: {{ $destination->promo_price }}</span>
                    </div>
                            <a href="#" class="btn" style="background-color: #2D2766; color: white;" class="mt-2" data-bs-toggle="modal" data-bs-target="#detailModal" onclick="populateModal('{{ Storage::url($destination->images[0] ?? 'default.jpg') }}', '{{ $destination->name }}', '{{ $destination->region }}', '{{ $destination->price }}', '{{ $destination->promo_price }}', '{{ $destination->hashtag }}', {{ $destination->id }}, `{{ str_replace(['`', "'", "\n", "\r"], ['\\`', "\\'", ' ', ' '], $destination->description) }}`)">View Detail</a>
                </div>
            </div>
        </div>
        @endforeach 
    </div>
</div>

<!-- Modal Popup -->
<div class="modal fade" id="detailModal" tabindex="-1" aria-labelledby="detailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg"> <!-- Changed to modal-lg for larger modal -->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="detailModalLabel">Detail Information</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img id="modalImage" src="" alt="Detail Image" class="img-fluid mb-3 w-100" style="border-radius: 10px; max-height: 500px; object-fit: cover; object-position: center;"> <!-- Increased max-height and width for larger image -->
                <h5 id="modalTitle" class="fw-bold"></h5>
                <p id="modalRegion" class="text-muted"></p>
                <p id="modalPrice" class="text-muted"></p>
                <p id="modalPromoPrice" class="text-muted"></p>
                <p id="modalHashtag" class="text-muted"></p>
                <p id="modalDescription" class="text-muted"></p>
                <p id="modalRentalDetails" class="text-muted"></p>
                <div class="mt-3 d-flex justify-content-center gap-2">
                    <button class="btn btn-success btn-sm" id="modalBookingBtn"><i class="bi bi-calendar-check"></i> Booking</button>
                    <button class="btn btn-outline-primary btn-sm" id="modalLikeBtn">
                        <i class="bi bi-hand-thumbs-up"></i> <span id="modalLikeText">Like</span> (<span id="modalLikeCount">0</span>)
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" id="modalCommentBtn"><i class="bi bi-chat"></i> Comment</button>
                    <button class="btn btn-outline-success btn-sm" id="modalShareBtn"><i class="bi bi-share"></i> Share</button>
                </div>
                <div class="comments-section mt-2" id="modalCommentsSection" style="display:none;">
                    <form class="form-comment d-flex mb-2" id="modalCommentForm">
                        <input type="text" name="comment" class="form-control form-control-sm me-2" placeholder="Write a comment..." required>
                        <button type="submit" class="btn btn-primary btn-sm">Post</button>
                    </form>
                    <div class="comments-list" id="modalCommentsList"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Include Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
let currentPackageId = null;
function populateModal(image, title, region, price, promoPrice, hashtag, id = null) {
    document.getElementById('modalImage').src = image;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalRegion').textContent = `Region: ${region}`;
    document.getElementById('modalPrice').textContent = '';
    document.getElementById('modalPromoPrice').textContent = '';
    document.getElementById('modalDescription').textContent = description ? `Deskripsi Wisata: ${description}` : '';
    document.getElementById('modalHashtag').textContent = `Hashtag: ${hashtag}`;
    currentPackageId = id;
    // Set booking button link
    if (id) {
        $('#modalBookingBtn').off('click').on('click', function() {
            window.location.href = '/booking/' + id;
        });
    }
    // Hide comments section initially
    $('#modalCommentsSection').hide();
    $('#modalCommentsList').empty();
}
function populateModal(image, title, region, price, promoPrice, hashtag, id = null, description = '') {
    document.getElementById('modalImage').src = image;
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalRegion').textContent = `Region: ${region}`;
    document.getElementById('modalPrice').textContent = '';
    document.getElementById('modalPromoPrice').textContent = '';
    document.getElementById('modalDescription').textContent = description ? `Deskripsi Wisata: ${description}` : '';
    document.getElementById('modalHashtag').textContent = `Hashtag: ${hashtag}`;
    currentPackageId = id;
    // Set booking button link
    $('#modalBookingBtn').off('click').on('click', function() {
        @if(!auth()->check())
            window.location.href = '/login';
        @else
            if (id) window.location.href = '/booking/' + id;
        @endif
    });
    // Hide comments section initially
    $('#modalCommentsSection').hide();
    $('#modalCommentsList').empty();
}

function updateLikeStatus() {
    if (!currentPackageId) return;
    $.get('/package/' + currentPackageId + '/like-count', function(data) {
        $('#modalLikeCount').text(data.count);
        $('#modalLikeText').text(data.liked ? 'Unlike' : 'Like');
    });
}

$(function() {
    // Show/hide comments section in modal
    $('#modalCommentBtn').on('click', function() {
        @if(!auth()->check())
            window.location.href = '/login';
            return;
        @endif
        $('#modalCommentsSection').toggle();
        if ($('#modalCommentsSection').is(':visible') && $('#modalCommentsList').is(':empty') && currentPackageId) {
            $.get('/package/' + currentPackageId + '/comments', function(data) {
                var list = $('#modalCommentsList');
                list.empty();
                data.comments.forEach(function(c) {
                    list.append('<div class="text-start mb-1"><strong>' + c.user + ':</strong> ' + c.comment + ' <small class="text-muted">' + c.created_at + '</small></div>');
                });
            });
        }
    });

    // Submit comment in modal
    $('#modalCommentForm').on('submit', function(e) {
        @if(!auth()->check())
            window.location.href = '/login';
            return false;
        @endif
        e.preventDefault();
        if (!currentPackageId) return;
        var input = $(this).find('input[name=comment]');
        var comment = input.val();
        var list = $('#modalCommentsList');
        $.post({
            url: '/package/' + currentPackageId + '/comment',
            data: {
                comment: comment,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                if(data.success) {
                    list.prepend('<div class="text-start mb-1"><strong>' + data.comment.user + ':</strong> ' + data.comment.comment + ' <small class="text-muted">' + data.comment.created_at + '</small></div>');
                    input.val('');
                }
            }
        });
    });

    $('#detailModal').on('show.bs.modal', function () {
        updateLikeStatus();
    });

    $('#modalLikeBtn').on('click', function() {
        @if(!auth()->check())
            window.location.href = '/login';
            return;
        @endif
        if (!currentPackageId) return;
        $.post({
            url: '/package/' + currentPackageId + '/like',
            data: {_token: '{{ csrf_token() }}'},
            success: function(data) {
                $('#modalLikeCount').text(data.count);
                $('#modalLikeText').text(data.liked ? 'Unlike' : 'Like');
            }
        });
    });
});
</script>
@endsection
