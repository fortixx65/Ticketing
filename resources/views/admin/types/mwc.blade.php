<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{$Active}}">
    <mwc-tab label="Profile" icon="person" stacked="" onclick='location.href="{{ route('admin.types.profil', $type)}}"'></mwc-tab>
    <mwc-tab label="Editer" icon="edit" stacked="" onclick='location.href="{{ route('admin.types.edit', $type)}}"'></mwc-tab>
</mwc-tab-bar>