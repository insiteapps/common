<% if $Content %>
    <article class="margin-bottom-30">
        $Content
    </article>
<% end_if %>

<div class="row">
    <% if $SidebarPosition = 'left' && $ShowSidebar %>
        <% include ListingSidebar %>
    <% end_if %>
    <div class="col-sm-9">
        <section id="ListingOuterContainer" data-parent="{$ID}" data-view="{$LayoutView}">
            <% include ListingActionBar %>
            <div id="ListingsHolder">
                <% include AllListingInner %>
            </div>

        </section>
    </div>
    <% if $SidebarPosition = 'right' && $ShowSidebar %>
        <% include ListingSidebar %>
    <% end_if %>
</div>

