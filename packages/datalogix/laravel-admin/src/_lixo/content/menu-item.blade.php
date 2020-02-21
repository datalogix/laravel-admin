<v-list-item
    @if ($subtitle) tow-line @endif
    @if ($href) href="{{ $href }}" @endif
    @if ($to) :to="{{ $to }}" @endif
    @if ($target) target="_blank" @endif
>
    @if ($iconAlign === 'left')
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
    @if ($iconAlign === 'right')
        <v-list-item-icon>
            @if ($icon)<v-icon>{{ $icon }}</v-icon>@endif
        </v-list-item-icon>
    @endif
</v-list-item>
