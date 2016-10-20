<div class="col-sm-3">
    <% if $FilterComponents %>
        <form id="FilterComponents" action="{$Link}">
            <% loop $FilterComponents %>
                <article class="SideBarItem">
                    $IncludeTemplate
                </article>
            <% end_loop %>

            <input type="submit" class="btn btn-primary" name="SubmitListingFilter" value="Search"/>
        </form>
    <% end_if %>
</div>
