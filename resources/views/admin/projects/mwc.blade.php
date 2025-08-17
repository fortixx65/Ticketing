<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{$Active}}">
    <mwc-tab label="Project" icon="inventory" stacked="" onclick='location.href="{{ route('admin.projects.action', $project)}}"'></mwc-tab>
    <mwc-tab label="Tickets" icon="analytics" stacked="" onclick='location.href="{{ route('admin.projects.tickets', $project)}}"'></mwc-tab>
    <mwc-tab label="Permissions" icon="analytics" stacked="" onclick='location.href="{{ route('admin.projects.permissions', $project)}}"'></mwc-tab>
    <mwc-tab label="Editer" icon="edit" stacked="" onclick='location.href="{{ route('admin.projects.edit', $project)}}"'></mwc-tab>
</mwc-tab-bar>