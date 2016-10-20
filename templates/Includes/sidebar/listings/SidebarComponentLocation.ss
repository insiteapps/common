<section>
    <ul class="TypeList clearUL">
        <% loop $SidebarComponentManager(ListItems) %>
            <li>
                <input class="nice_checkbox setisotopehash" type="checkbox"
                       name="locations[$ID]" data-rel="$ID" value="{$ID}"
                       id="locations[$ID]"/>
                <label for="locations[$ID]"><span></span>{$Title}
                </label>
            </li>
        <% end_loop %>
    </ul>
</section>
