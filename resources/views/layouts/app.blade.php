<?php echo View::make('includes/document_start'); ?>
<div class="row">
    <div class="col s10 push-s1">
        @if (session('success'))
            <div class="alert card-panel green">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert card-panel red">
                {{ session('error') }}
            </div>
        @endif
            @if (session('warning'))
                <div class="alert card-panel orange">
                    {{ session('warning') }}
                </div>
            @endif

        @if (Auth::guest())
            <?php echo View::make('includes/elements/login'); ?>
        @else
            @yield('content')
        @endif
    </div>
</div>
<?php echo View::make('includes/document_end'); ?>
