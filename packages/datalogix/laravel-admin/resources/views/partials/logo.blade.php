@if (config('admin.icon') || config('admin.show_name'))
    <v-btn href="{{ admin_url() }}" @if (!config('admin.show_name')) icon @endif text>
        @if (config('admin.icon'))
            <v-avatar size="32px" class="mx-4">
                <v-img src="{{ config('admin.icon') }}" alt="{{ config('admin.name') }}" />
            </v-avatar>
        @endif

        @if (config('admin.show_name'))
            <v-toolbar-title class="text-none">
                {{ config('admin.name') }}
            </v-toolbar-title>
        @endif
    </v-btn>
@endif
