<div class="container-main" ng-controller="{$URLSegment}">
    <h1>Player</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <th>Name</th>
            <th>Games Played</th>
            <tbody>
            <% with $Player %>
                <tr>
                    <td>$Name</td>
                    <td>$GamesPlayed</td>
                </tr>
            <% end_with %>
            </tbody>
        </table>
        <a href="$ParentLink" class="btn btn-primary">Back to Players</a>
    </div>
</div>