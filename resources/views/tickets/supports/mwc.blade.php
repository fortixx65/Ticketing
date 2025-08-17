<mwc-tab-bar style="margin-bottom: -1px" activeindex="{{$Active}}">
    <mwc-tab label="Arriver" icon="inventory" stacked="" onclick='location.href="{{ route('tickets.supports.news', $project)}}"'></mwc-tab>
    <mwc-tab label="Tickets en cours" icon="analytics" stacked="" onclick='location.href="{{ route('tickets.supports.in_progress', $project)}}"'></mwc-tab>
    <mwc-tab label="Documentation" icon="edit" stacked="" onclick='location.href="{{ route('tickets.supports.documentation', $project)}}"'></mwc-tab>
</mwc-tab-bar>