<v-menu offset-y>
    <template v-slot:activator="{ on }">
        <v-btn @if (!$user->name || !config('admin.show_user_name')) icon @endif text v-on="on">
            <v-avatar left size="32px">
                @if ($user->avatar)
                    <v-img src="{{ $user->avatar }}" alt="{{ $user->name}}"></v-img>
                @else
                    <v-icon>mdi-account-circle</v-icon>
                @endif
            </v-avatar>

            @if ($user->name && config('admin.show_user_name'))
                <span class="d-none d-md-block text-none">
                    {{ $user->name }}
                </span>
            @endif
        </v-btn>
    </template>

    <v-list min-width="200" class="pa-0">
        <v-list-item :to="{name: 'user-account'}" exact>
            <v-list-item-icon>
                <v-icon>mdi-account</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>{{ __('admin::general.account') }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item :to="{name: 'user-settings'}" exact>
            <v-list-item-icon>
                <v-icon>mdi-settings</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>{{ __('admin::general.settings') }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>

        <v-list-item href="{{ route('admin.logout') }}">
            <v-list-item-icon>
                <v-icon>mdi-logout</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
                <v-list-item-title>{{ __('admin::general.logout') }}</v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</v-menu>
