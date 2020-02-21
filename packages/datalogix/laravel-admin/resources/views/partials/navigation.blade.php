<v-navigation-drawer v-model="drawer" app clipped>
    <v-list class="pa-0">
        @foreach ($tools as $tool)
            {!! $tool->navigation() !!}
        @endforeach
    </v-list>
</v-navigation-drawer>
