<v-navigation-drawer v-model="drawer" app clipped>
    <v-list>
        @foreach ($tools as $tool)
            {!! $tool->navigation() !!}
        @endforeach
    </v-list>
</v-navigation-drawer>
