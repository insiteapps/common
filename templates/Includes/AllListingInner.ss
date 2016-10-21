<section class="ListingContainer">
    <% if $ActiveListings %>
        <% include ListingPagination %>
        <section id="ListItemsContainer" class="isotopeContainer {$LayoutView} ">
            <section id="LayoutView" class="{$LayoutView}">
                <% loop $ActiveListings %>
                    <% include ActiveListingItem %>

                <% end_loop %>
            </section>
        </section>
        <% include ListingPagination %>
    <% end_if %>
</section>
