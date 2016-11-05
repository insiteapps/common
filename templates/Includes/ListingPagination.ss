<% if $MoreThanOnePage %>

    <div class="ListControls">

            <ul class="pagination pagination pull-left">
                <% if $NotFirstPage %>
                    <li><a class="listNav" href="{$PrevLink}" data-rel="prev">&laquo;</a></li>
                <% else %>
                    <li class="disabled "><a href="javascript:">&laquo;</a></li>
                <% end_if %>

                <% loop $PaginationSummary(5) %>
                    <% if $CurrentBool %>
                        <li class="active"><a href="javascript:" data-rel="$PageNum">$PageNum</a>
                        </li>
                    <% else %>
                        <% if $Link %>
                            <li><a href="$Link" data-rel="$PageNum">$PageNum</a></li>
                        <% else %>
                            <li><a href="javascript:">...</a></li>
                        <% end_if %>
                    <% end_if %>
                <% end_loop %>
                <% if $NotLastPage %>
                    <li><a class="listNav" href="{$NextLink}" data-rel="next">&raquo;</a></li>
                <% else %>
                    <li class="disabled"><a  href="javascript:" data-rel="next">&raquo;</a></li>
                <% end_if %>
            </ul>


    </div>




<% end_if %>
