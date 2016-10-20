<section>
    <ul class="TypeList clearUL">
        <% loop $SidebarComponentManager(ListItems) %>
            <li>
                <input class="nice_checkbox setisotopehash" type="checkbox"
                       name="areas[$ID]" data-rel="$ID" value="{$ID}"
                       id="areas[$ID]"/>
                <label for="areas[$ID]"><span></span>{$Title}
                </label>
            </li>
        <% end_loop %>
    </ul>
</section>
