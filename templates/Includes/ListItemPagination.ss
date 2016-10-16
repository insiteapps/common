<div class="ListControls">
    <% if $ActiveListings.MoreThanOnePage %>

        <ul class="ListingPagination pagination">
        <% if $ActiveListings.NotFirstPage %>
            <li><a class="listNav" href="javascript:" data-rel="prev">&laquo;</a></li>
        <% else %>
            <li class="disabled "><a href="javascript:">&laquo;</a></li>
        <% end_if %>

        <% loop $ActiveListings.PaginationSummary(5) %>
            <% if $CurrentBool %>
                <li class="active"><a href="javascript:" data-rel="$PageNum">$PageNum</a>
                </li>
            <% else %>
                <% if $Link %>
                    <li><a href="javascript:" data-rel="$PageNum">$PageNum</a></li>
                <% else %>
                    <li><a href="javascript:">...</a></li>
                <% end_if %>
            <% end_if %>
        <% end_loop %>
        <% if $ActiveListings.NotLastPage %>
            <li><a class="listNav" href="javascript:" data-rel="next">&raquo;</a></li>
        <% else %>
            <li class="disabled"><a  href="javascript:" data-rel="next">&raquo;</a></li>
        <% end_if %>
        </ul>

    <% end_if %>
</div>