<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <% if Teams %>
        <div class="container">
            <h3>Winner: $Winner - Score: $Score</h3>
        </div>
        <table class="table table-striped table-border table-hover">
            <th>Team</th>
            <th>Games Played</th>
            <tbody>
                <% loop Teams %>
                    <% with TeamOne %>
                    <tr>
                        <td>$Names</td>
                        <td>$GamesPlayed</td>
                    </tr>
                    <% end_with %>
                    <% with TeamTwo %>
                    <tr>
                        <td>$Names</td>
                        <td>$GamesPlayed</td>
                    </tr>
                    <% end_with %>
                <% end_loop %>
            </tbody>
        </table>
        <% else %>
            $Content
        <% end_if %>
    </div>
    <div class="container paddingtop">
    <% if AddNewTeam %>
        <div class="row">
            $AddNewTeam
        </div>
    <% end_if %>
        <div class="row paddingtop">
            <a class="btn btn-warning" href="$ParentLink">See all Games</a>
        </div>
    </div>
</div>