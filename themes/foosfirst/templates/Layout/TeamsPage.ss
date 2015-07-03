<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <tbody>
                <% loop Teams %>
                    <tr>
                        $Me
                    </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
</div>