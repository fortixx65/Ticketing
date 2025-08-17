<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{ $Active }}">
    <mwc-tab label="Profile" icon="person" stacked="" onclick='location.href="{{ route('admin.roles.profil', $role) }}"'></mwc-tab>
    <mwc-tab label="Permission" icon="shopping_cart" stacked="" onclick='location.href="{{ route('admin.roles.permission', $role) }}"'></mwc-tab>
    <mwc-tab label="Utilisateur" icon="shopping_cart" stacked="" onclick='location.href="{{ route('admin.roles.users', $role) }}"'></mwc-tab>
    <mwc-tab label="Editer" icon="edit" stacked="" onclick='location.href="{{ route('admin.roles.edit', $role) }}"'></mwc-tab>
</mwc-tab-bar>
