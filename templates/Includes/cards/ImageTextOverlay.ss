<div class="card" data-background="image" data-src="{$Image.URL}">
    <div class="header">
        <% if $Trending %>
            <div class="category">
                <h6 class="label label-warning">Trending Post</h6>
            </div>
        <% end_if %>

        <div class="social-line" data-buttons="3">
            <button class="btn btn-social btn-facebook">
                <i class="fa fa-facebook-square"></i> Share
            </button>
            <button class="btn btn-social btn-twitter">
                <i class="fa fa-twitter"></i> Tweet
            </button>
            <button class="btn btn-social btn-pinterest">
                <i class="fa fa-pinterest"></i> Pin
            </button>
        </div>
    </div>

    <div class="content">
        <h4 class="title"><a href="{$Link}">{$Title}</a></h4>
        <p class="description">
            {$PageSummary}
        </p>
    </div>
    <div class="filter"></div>
</div> <!-- end card -->
