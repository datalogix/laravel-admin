<v-app-bar app color="black" dark clipped-left>
    <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>

    @include('admin::partials.logo')

    <v-spacer></v-spacer>

    @if ($globalSearch)
        <global-search></global-search>
    @endif

    <v-spacer></v-spacer>

    @if (config('admin.notifications'))
        <notifications></notifications>
    @endif

    @include('admin::partials.user')
</v-app-bar>
