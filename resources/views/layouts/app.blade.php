<?php echo View::make('includes/document_start'); ?>
<div class="row">
    <div class="col s12">
        @if (Auth::guest())
            <?php echo View::make('includes/elements/login'); ?>
        @else
            @yield('content')
        @endif
    </div>
</div>
<?php echo View::make('includes/document_end'); ?>
