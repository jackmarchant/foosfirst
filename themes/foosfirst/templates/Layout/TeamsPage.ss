<div class="container-main" ng-controller="{$URLSegment}">
    <h1>$Title</h1>
    <div class="container-main">
        <table class="table table-striped table-border table-hover">
            <th>Player 1</th>
            <th>Player 2</th>
            <th>Games Played</th>
            <tbody>
                <% loop Teams %>
                    <tr>
                        <td>$PlayerOne</td>
                        <td>$PlayerTwo</td>
                        <td>$GamesPlayed</td>
                    </tr>
                <% end_loop %>
            </tbody>
        </table>
    </div>
    <div class="container">
        <a href="{$BaseHref}{$URLSegment}/addteam" class="btn btn-success">Add new Team</a>
    </div>
</div>