@props(['banners','banners_small'])

<!-- Banner + Right banners -->
<div class="section-block section-block--no-top-margin">
  <div class="row g-3">
    <!-- Center: Main banner (carousel) -->
    <div class="col-lg-8">
      <a href="#" class="d-block">
        <div id="mainBanner" class="carousel slide main-banner-wrapper">
          <div class="carousel-inner">
            @forelse($banners as $banner)
            <div class="carousel-item active">
              <img
                src="{{ $banner->image ? asset('storage/'.$banner->image) : 'https://placehold.co/900x400?text=Banner' }}"
                class="d-block w-100"
                alt="{{ $banner->title }}"
              />
            </div>
              @empty
            <div class="carousel-item active">
              <img
                src="https://placehold.co/900x400?text=Banner"
                class="d-block w-100"
                alt=""
              />
            </div>
            @endforelse
          </div>
          <button
            class="carousel-control-prev"
            type="button"
            data-bs-target="#mainBanner"
            data-bs-slide="prev"
          >
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button
            class="carousel-control-next"
            type="button"
            data-bs-target="#mainBanner"
            data-bs-slide="next"
          >
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
        </div>
      </a>
    </div>

    <!-- Right: small banners -->
    <div class="col-lg-4">
      <div class="d-flex flex-column gap-2 right-banner">
            @forelse($banners_small as $banner)
            <a href="#" class="d-block">
              <img
                src="{{ $banner->image ? asset('storage/'.$banner->image) : 'https://placehold.co/900x400?text=Banner' }}"
                class="img-fluid img-fluid w-100"
                alt="{{ $banner->title }}"
              />
            </a>
              @empty
            <div class="carousel-item active">
              <img
                src="https://placehold.co/900x400?text=Banner"
                class="d-block w-100"
                alt=""
              />
            </div>
            @endforelse
      </div>
    </div>
  </div>
</div>

@push('scripts')
<script>
  // Auto carousel
  var mainBanner = document.querySelector("#mainBanner");
  if (mainBanner) {
    var carousel = new bootstrap.Carousel(mainBanner, {
      interval: 4000,
      ride: "carousel",
    });
  }

  // Countdown sale 30 phút (1800 giây)
  var countdownElement = document.getElementById("saleCountdown");
  var countdownSeconds = 30 * 60; // 30 phút

  function updateCountdown() {
    if (!countdownElement) return;
    var minutes = Math.floor(countdownSeconds / 60);
    var seconds = countdownSeconds % 60;

    var m = String(minutes).padStart(2, "0");
    var s = String(seconds).padStart(2, "0");
    countdownElement.textContent = m + ":" + s;

    if (countdownSeconds > 0) {
      countdownSeconds--;
    }
  }

  updateCountdown();
  setInterval(function () {
    if (countdownSeconds > 0) {
      updateCountdown();
    }
  }, 1000);
</script>
@endpush

