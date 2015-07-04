<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <th>Team</th>
            <th>Games Played</th>
            <tbody>
                <% loop Teams %>
                    <tr>
                        <td>$Names</td>
                        <td>$GamesPlayed</td>
                    </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
    <div class="container paddingtop">
        <a class="btn btn-warning" href="$ParentLink">See all Games</a>
    </div>
</div>