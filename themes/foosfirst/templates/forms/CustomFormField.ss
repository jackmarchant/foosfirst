<% if $isReadonly %>
    <span id="$ID"<% if $extraClass %> class="$extraClass"<% end_if %>>
        $Value
    </span>
<% else %>
    <input $AttributesHTML class="form-control" />
<% end_if %>
