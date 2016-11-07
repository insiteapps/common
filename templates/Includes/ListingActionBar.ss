<% if $AllowViewChange %>
    <div class="wp-block default product-list-filters light-gray">

        <% with $ActiveListings %>
            <% include ListingPagination %>
        <% end_with %>

        <div class="filter sort-filter pull-right">
            <select id="sort" class="form-control">
                <option value="">sort by</option>
                <option value="title;asc">Name asc</option>
                <option value="title;desc">Name desc</option>
                <option value="price;asc">Price low</option>
                <option value="price;desc">Price high</option>
            </select>
        </div>
        <ul class="ListLayout list-unstyled list-inline">
            <li>
                <a data-rel="grid" href="javascript:void(0);"
                   <% if $LayoutView = 'grid' %>class="active"<% end_if %>>
                    <i class="fa fa-th-large"></i>
                </a>
            </li>
            <li>
                <a data-rel="list" href="javascript:void(0);"
                   <% if $LayoutView = 'list' %>class="active"<% end_if %>>
                    <i class="fa fa-bars"></i>
                </a>
            </li>
        </ul>
    </div>
<% end_if %>
