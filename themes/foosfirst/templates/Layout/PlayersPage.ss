<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <th>Name</th>
            <th>Games Played</th>
            <th>View Player</th>
            <tbody>
                <% loop Players %>
                    <tr>
                        <td>$Name</td>
                        <td>$GamesPlayed</td>
                        <td><a class="btn btn-primary" href="{$BaseHref}{$Top.URLSegment}/{$PlayerLink}">View</a></td>
                    </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
    <div class="actions">
        <a href="{$BaseHref}{$URLSegment}/addplayer" class="btn btn-success">Add new Player</a>
    </div>
</div>