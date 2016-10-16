<% if $ActiveListings.MoreThanOnePage %>
<section class="ListingFiltering">
    <div class="row">

        <div class="col-sm-6">
            <% include ListItemPagination %>
        </div>

    </div>

</section>
<% end_if %>