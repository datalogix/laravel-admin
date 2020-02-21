<v-btn href="{{ admin_url() }}" @if (!config('admin.show_name')) icon @endif text>
    @if (config('admin.logo'))
        <v-avatar size="32px" class="mx-4">
            <v-img src="{{ config('admin.logo') }}" alt="{{ config('admin.name') }}" />
        </v-avatar>
    @endif

    @if (config('admin.show_name'))
        <v-toolbar-title class="text-none">
            {{ config('admin.name') }}
        </v-toolbar-title>
    @endif
</v-btn>
