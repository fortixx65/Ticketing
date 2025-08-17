<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{$Active}}">
    <mwc-tab label="Profile" icon="person" stacked="" onclick='location.href="{{ route('admin.users.profil', $user)}}"'></mwc-tab>
    <mwc-tab label="Logs" icon="history" stacked="" onclick='location.href="{{ route('admin.users.logs', $user)}}"'></mwc-tab>
    <mwc-tab label="Editer" icon="edit" stacked="" onclick='location.href="{{ route('admin.users.edit', $user)}}"'></mwc-tab>
</mwc-tab-bar>