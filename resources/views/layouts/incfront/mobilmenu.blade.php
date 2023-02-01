<div class="mobile-menu-container">
    <div class="mobile-menu-wrapper">
        <span class="mobile-menu-close"><i class="icon-close"></i></span>

        <form action="{{ url('buscarproducto') }}" method="POST" class="mobile-search">
            {{ csrf_field() }}
            <label for="mobile-search" class="sr-only">Search</label>
            <input type="search" class="form-control" name="product_name" id="search_product" placeholder="Search Products..." required>
            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
        </form>

        <nav class="mobile-nav">
            <ul class="mobile-menu">
                <li class="active">
                    <a href="{{ url('/') }}">Home</a>
                </li>
                <li>
                    <a href="{{ url('category') }}">Categories</a>
                    <ul>
                        @foreach ($categories as $cat)
                            <li><a href="{{ url('view-category/'.$cat->slug) }}">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            </ul>
        </nav><!-- End .mobile-nav -->

        <div class="social-icons">
            <a href="" class="social-icon" target="_blank" title="Facebook"><i class="icon-facebook-f"></i></a>
            <a href="" class="social-icon" target="_blank" title="Twitter"><i class="icon-twitter"></i></a>
            <a href="" class="social-icon" target="_blank" title="Instagram"><i class="icon-instagram"></i></a>
            <a href="" class="social-icon" target="_blank" title="Youtube"><i class="icon-youtube"></i></a>
        </div><!-- End .social-icons -->
    </div><!-- End .mobile-menu-wrapper -->
</div><!-- End .mobile-menu-container -->
