<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <th>Winner</th>
            <th>Team One</th>
            <th>Team Two</th>
            <th>Date</th>
            <th>View Game</th>
            <tbody>
                <% loop Games %>
                    <tr>
                        <td>$Winner</td>
                        <td>$ScoreTeamOne</td>
                        <td>$ScoreTeamTwo</td>
                        <td>$Created.Nice</td>
                        <td><a class="btn btn-primary" href="{$BaseHref}{$Top.URLSegment}/{$GameLink}">View</a></td>
                    </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
</div>