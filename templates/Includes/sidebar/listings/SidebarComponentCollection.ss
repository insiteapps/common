<section>
    <ul class="TypeList clearUL">
        <% loop $SidebarComponentManager(ListItems) %>
            <li>
                <input class="nice_checkbox setisotopehash" type="checkbox"
                       name="collection[$ID]" data-rel="$ID" value="{$ID}"
                       id="collection[$ID]"/>
                <label for="collection[$ID]"><span></span>{$Title}
                </label>
            </li>
        <% end_loop %>
    </ul>
</section>
