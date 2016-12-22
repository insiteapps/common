<article
        class="list-item isotopeitem {$filterCategories} {$Parent.MakeSameHeight}  <% if $Parent.RemoveChildLinking %>normalIcon<% end_if %> col-sm-{$Parent.ColumnsSpanWidth}"
        itemtype="https://schema.org/LodgingBusiness">
    <div class="row">

        <section class="list-item-grid-container ">
            <% if $Image %>
                <div class="figure-container col-sm-4 col-md-3">
                    <figure itemtype="http://schema.org/ImageObject">
                        <a href="$Link" itemprop="url"
                           class=" <% if not $Parent.RemoveOverlay %> img-mask-effect fade scaleimage <% end_if %>">
                            <img itemprop="image" src="{$Image.URL}"
                                 class="img-responsive"
                                 alt="{$Name}"/>
                            <% if not $Parent.RemoveOverlay %><i class="mask"><span
                                    class="glyphicon glyphicon-search"></span></i><% end_if %>
                        </a>
                    </figure>
                </div>
            <% end_if %>
            <article
                    class="list-item-details <% if $Image %>col-sm-8 col-md-9<% else %>col-sm-12<% end_if %>">
                <div class="listing-details">
                    <h3 class="listing-title">
                        <a href="$Link" itemprop="url">{$Title}</a>
                    </h3>
                    <article class="content-summary">  $ContentSummary(200)</article>

                    <% if not $Parent.RemoveReadMore %>
                        <a href="{$Link}" class="btn btn-{$Parent.ReadMoreButtonClass}">
                            {$Parent.ReadMoreText}
                        </a>
                    <% end_if %>
                </div>
            </article>

        </section>

    </div>
</article>
