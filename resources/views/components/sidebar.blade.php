@props(['sections'])

<nav class="col-md-3 col-lg-2 d-md-block sidebar collapse">
    <div class="position-sticky pt-3">
        <div class="sidebar-brand text-center mb-4">
            <h4 class="text-white">
                <i class="fas fa-chart-line"></i>
                ERP El Salvador
            </h4>
        </div>

        @foreach ($sections as $section)
            <x-nav-section :section="$section" />
        @endforeach
    </div>
</nav>