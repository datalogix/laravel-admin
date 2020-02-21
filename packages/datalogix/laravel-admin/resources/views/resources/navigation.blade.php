@if (count($resources) > 0)
    @if (config('admin.navigation.resources'))
        <v-subheader>{{ __(config('admin.navigation.resources')) }}</v-subheader>
    @endif

    @foreach ($resources as $group => $resourcesGrouped)
        @if (count($resources) > 1 && $group)
            <v-list-group
                @if (config('admin.navigation.group_icons.' . $group))
                    prepend-icon="{{ config('admin.navigation.group_icons.' . $group) }}"
                @endif
            >
                <template v-slot:activator>
                    <v-list-item-title>
                        {{ $group }}
                    </v-list-item-title>
                </template>
        @endif

        @foreach ($resourcesGrouped as $key => $resource)
            <v-list-item :to="{name: 'resource', params: {resourceName: '{{ $key }}'}}">
                <v-list-item-icon>
                    @if ($resource::icon())
                        <v-icon>{{ $resource::icon() }}</v-icon>
                    @endif
                </v-list-item-icon>
                <v-list-item-content>
                    <v-list-item-title>
                        {{ $resource::title() }}
                    </v-list-item-title>
                    @if ($resource::subtitle())
                        <v-list-item-subtitle>
                            {{ $resource::subtitle() }}
                        </v-list-item-subtitle>
                    @endif
                </v-list-item-content>
            </v-list-item>
        @endforeach

        @if (count($resources) > 1 && $group)
            </v-list-group>
        @endif
    @endforeach
@endif
