<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{$Active}}">
    <mwc-tab label="Priorité" icon="person" stacked="" onclick='location.href="{{ route('admin.priority.action', $priority)}}"'></mwc-tab>
    <mwc-tab label="Editer" icon="edit" stacked="" onclick='location.href="{{ route('admin.priority.edit', $priority)}}"'></mwc-tab>
</mwc-tab-bar>