<section>
    <ul class="TypeList clearUL">
        <% loop $SidebarComponentManager(ListItems) %>
            <li>
                <input class="nice_checkbox setisotopehash" type="checkbox"
                       name="types[$ID]" data-rel="$ID" value="{$ID}"
                       id="types[$ID]"/>
                <label for="types[$ID]"><span></span>{$Title}
                </label>
            </li>
        <% end_loop %>
    </ul>
</section>


