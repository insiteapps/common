<div class="row">
    <div class="col-sm-8 col-md-9">
        <section id="PropertyContainer" data-parent="{$ID}" data-view="{$LayoutView}">

            <% include PropertyActionBar %>

            <div id="PropertyInnerContainer" class="row isotopeContainer {$LayoutView}">
                <% loop $Properties %>
                    <article class="list-item isotopeitem  col-smx-6 col-sm-6 col-md-4 {$filterCategories}"
                             itemtype="https://schema.org/LodgingBusiness">

                        <div class="row">
                            <section class="list-item-grid-container">
                                <% if $Image %>
                                    <div class="figure-container col-sm-4 col-md-3">
                                        <figure itemtype="http://schema.org/ImageObject">
                                            <a href="$Link" itemprop="url">
                                                <img itemprop="image" src="{$Image.CroppedResize(520,520).URL}"
                                                     class="img-responsive"
                                                     alt="{$Name}"/>
                                            </a>
                                        </figure>
                                    </div>
                                <% end_if %>
                                <article
                                        class="list-item-details <% if $Image %>col-sm-8 col-md-9<% else %>col-sm-12<% end_if %>">
                                    <div class="listing-details">
                                        <% if $Areas %>
                                            <h4 class="area-name">
                                                <% loop $Areas %>
                                                    <a href="{$Link}">{$Title}</a>
                                                    <% if not $Last %>
                                                        ,
                                                    <% end_if %>
                                                <% end_loop %>
                                            </h4>
                                        <% end_if %>
                                        <h3 class="listing-title">
                                            <a href="$Link" itemprop="url">{$Title}</a>
                                        </h3>


                                        <div class="listing-excerpt">
                                            <div class="row">
                                                <div class="listing-desc col-sm-8 col-md-9">
                                                    <div id="listing-{$ID}" class="listingExcerptBox">
                                                <span itemprop="description">
                                                {$ContentSummary(250)}
                                            </span>
                                                        <% if $Types %>
                                                            <ul class="list-unstyled list-inline">
                                                                <% loop $Types %>
                                                                    <li><img src="{$Icon.URL}" title="{$Name}"/>
                                                                    </li>
                                                                <% end_loop %>
                                                            </ul>
                                                        <% end_if %>
                                                    </div>
                                                </div>
                                                <div class="miniRateHolderMain col-sm-4 col-md-3">
                                                    <div class="miniRateHolder">
                                                        <% if $Rate %>
                                                            <span class="rate-from-title">From</span>
                                                            <span class="rate-from">R{$Rate}</span>
                                                        <% end_if %>
                                                        <a href="{$Link}"
                                                           class="btn btn-primary btn-lg btn-rounded">Details</a>
                                                    </div>
                                                </div>

                                            </div>


                                        </div>
                                    </div>
                                    <!--property-details-->
                                </article>
                            </section>
                        </div>

                    </article>
                <% end_loop %>
            </div>
        </section>

    </div>
</div>
