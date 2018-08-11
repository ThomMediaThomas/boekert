<?php echo View::make('includes/document_start'); ?>
<div class="container">
    @if (Auth::guest())
        <?php echo View::make('includes/elements/login'); ?>
    @else

    @endif
</div>
<?php echo View::make('includes/document_end'); ?>
