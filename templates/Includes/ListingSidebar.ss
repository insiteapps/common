<div class="col-sm-3">
    <% if $FilterComponents %>
        <form id="FilterComponents" action="{$Link}">
            <% loop $FilterComponents %>
                <article class="SideBarItem">
                    <% if not $RemoveTitle %>
                        <h3 class="sidebar-header-title">{$Title}</h3>
                    <% end_if %>
                    $IncludeTemplate
                </article>
            <% end_loop %>

            <input type="submit" class="btn btn-primary" name="SubmitListingFilter" value="Search"/>
        </form>
    <% end_if %>
</div>
