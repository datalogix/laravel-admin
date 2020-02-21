<v-app-bar app color="deep-purple accent-4" dark clipped-left>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

    @include('admin::partials.logo')

    <v-spacer></v-spacer>

    @if ($globalSearch)
        <global-search></global-search>
        <v-spacer></v-spacer>
    @endif

    @include('admin::partials.notifications')
    @include('admin::partials.user')
</v-app-bar>
