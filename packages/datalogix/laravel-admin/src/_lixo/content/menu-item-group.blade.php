<v-list-group
    @if ($subgroup) no-action sub-group @endif
    @if ($opened) value="true" @endif
>
    <template v-slot:activator>
        @if (!$subgroup)
            <v-list-item-icon>
                @if ($icon)<v-icon>{{ $icon }}</v-icon>@endif
            </v-list-item-icon>
        @endif
        <v-list-item-content>
            <v-list-item-title>{{ $title }}</v-list-item-title>
            @if ($subtitle))
                <v-list-item-subtitle>{{ $subtitle }}</v-list-item-subtitle>
            @endif
        </v-list-item-content>
        @if ($subgroup && $icon)
            <v-list-item-icon>
                <v-icon>{{ $icon }}</v-icon>
            </v-list-item-icon>
        @endif
    </template>

    @foreach ($elements as $element)
        {!! $element !!}
    @endforeach
</v-list-group>
